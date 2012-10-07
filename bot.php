<?php
require_once('twitteroauth/twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('magic.php');
require_once('lib.php');

$bad_words = array(
  'video',
  'ft.',
  'feat[. ]',
  'playin',
  'np',
  '^RT',
  '^@',
  'http',
  'via @',
  'RT @',
  ':',
  '@',
  'Stolas_REAL',
);

$searches = array(
    'stolas',
    'lucifer',
    'satan',
    'horoscope',
    'prana',
    'yoga',
    'astrology',
    'namaste',
    'jung',
    'freud',
    'vinyasa',
    'soul',
    'concious',
    'pray',
    'jesus',
    'allah',
    'genie',
    'djinn',
    'cosmic',
    'astral',
    'eternal',
    'god',
    'billion',
    "scorpio",
    "aquarius",
    "gemini",
    "virgo",
    "aries",
    "pisces",
    "sagittarius",
    "libra",
    "leo",
);

$user_wait_time = 86400; // time before responding to user again

/////////////////////////////////////////////////////////////////////////////////////////
date_default_timezone_set('America/New_York');

$path = dirname(__FILE__);
$state = json_decode(@file_get_contents("$path/STATE"), true);
if(!$state) {
    $state = array(
        'time'=>0,
        'users'=>array(),
        'consider'=>array(),
    );
}
$consider=$state['consider'];

$magic = new Magic();
$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);



$twitter->host = "https://api.twitter.com/1/";
$tweets = $twitter->get('statuses/friends_timeline',array('count' => 140));

$tweets = array_filter($tweets, function($tweet) {
    global $bad_words, $searches;

    $tweet->score=0;


    foreach($bad_words as $word) {
        $flag = (($word==strtolower($word))?"i":'');
        if(preg_match("/$word/$flag",$tweet->text) != false) {
            //echo "REJECT($word): ", $tweet->text,"\n";
            $tweet->score-=70;
            break;
        }
    }

    $time = strtotime($tweet->created_at);

    if($tweet->retweeted) $tweet->score-=20;
    if($tweet->in_reply_to_screen_name) $tweet->score-=10;
    $tweet->score+=100*palindrome($tweet->text);
    $tweet->score+=3*min(30,$tweet->retweet_count);
    $tweet->score+=30*($tweet->text==strtoupper($tweet->text));
    $tweet->score+=20*($tweet->text==strtolower($tweet->text));
    $tweet->score+=30*(strtoupper($tweet->text)==strtolower($tweet->text));
    $tweet->score+=10*preg_match('/  /',$tweet->text);
    $tweet->score+=80*preg_match('/stolas/i',$tweet->in_reply_to_screen_name);
    $tweet->score+=40*preg_match('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', $tweet->text);
    $tweet->score+=30*($tweet->source!='web');
    $tweet->score+=0.003*min(10000,$tweet->user->statuses_count);
    $tweet->score+=0.03*min(1000,$tweet->user->favourites_count);
    $tweet->score-=20*$tweet->user->verified;

    foreach($searches as $word) {
        $flag = (($word==strtolower($word))?"i":'');
        if(preg_match("/$word/$flag",$tweet->text) != false) {
            //echo "ACCEPT($word): ", $tweet->text,"\n";
            $tweet->score++;
        }
    }


    return true;
    return $tweet->score>-1;
});

//print_r($tweets);
//exit;

$used=array();
$time_parts=localtime(time(),true);
$yes=false;

foreach($tweets as $tweet) {
    if(in_array($tweet,$used)) break;

    $user=$tweet->user->screen_name;
    $time = strtotime($tweet->created_at);
    if($time<=@$state['consider'][$user]) break;
    $consider[$user]=$time;

    $difficulty = 1000
        + 250  * $yes // be less likely with sequential tweets
        - 200  *( time() - $state['time'] > $user_wait_time ) // be more likely if we havent succeeded in a while
        - 150  *( time() - $time <= 60 ) // be more likely if the tweet was in last 60 seconds
        - 100  *( time() - $time <= 300 ) // be more likely if the tweet was in last 5 min
        + 250  *( !in_array($time_parts['tm_wday'],array(0,6)) && in_array($time_parts['tm_hour'],range(6,20)) ) // be more difficult during work week
        - 300  *( in_array($time_parts['tm_hour'],range(0,4)) ) // more late night
    ;
    $yes=$tweet->score > rand(0,$difficulty);


    $txt = $magic->generate();
    $status = '@'. $user." $txt";

    $params['status']=$status;
    $params=array(
        'in_reply_to_status_id'=>$tweet->id_str,
        'status'=>$status,
    );

    if($yes && strlen($status)<=140 &&
        $time-@$state['users'][$user]>$user_wait_time &&
        time()-@$state['users'][$user]>$user_wait_time &&
        time()-$time<$user_wait_time ){
            $yes = true;
            $used[]=$tweet;
            $state['users'][$user]=time();
            $twitter->post('statuses/update', $params); $state['time']=time();
    }
    else {
        $yes = false;
    }
    file_put_contents("$path/STATE",json_encode($state));

    if(true||$yes) {
        echo "DIFF=$difficulty,SCORE={$tweet->score},YES=$yes\n";
        echo $tweet->user->screen_name, ":: ", $tweet->text,"\n";
        echo $status,"\n\n";
        //sleep(rand(60,120));
    }
    if($yes)
        sleep(5);

}
$state['consider']=$consider;
file_put_contents("$path/STATE",json_encode($state));
