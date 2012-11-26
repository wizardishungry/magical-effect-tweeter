<?php
require_once('twitteroauth/twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('magic.php');
require_once('lib.php');
require_once('outfit_bot.php');
require_once('stellar_bot.php');
require_once('plant_bot.php');

$path = dirname(__FILE__);

$flags=FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES;
$searches  = file("$path/whitelist.txt",$flags);
$bad_words = file("$path/blacklist.txt",$flags);
$soundexs= array_map(function($e){
    if(strlen($e)<5) return;
    if(preg_match('/\W/',$e))
        return false;
    $v = soundex(soundex_prepare($e,' '));
    return ($v ? $v : false);
},$searches);
$soundexs=array_unique($soundexs);

$one_day=86400;
$user_wait_time = 2*7*$one_day; // time before responding to user again

/////////////////////////////////////////////////////////////////////////////////////////
date_default_timezone_set('America/New_York');

$state = json_decode(@file_get_contents("$path/STATE"), true);
if(!$state) {
    $state = array(
        'time'=>0,
        'users'=>array(),
        'consider'=>array(),
        'outfit'=>array(),
        'stellar'=>0,
        'plant'=>0,
    );
}
$consider=$state['consider'];

$magic = new Magic();
$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$outfit_bot = new OutfitBot(@$state['outfit'],$twitter);
$stellar_bot = new StellarBot(@$state['stellar'],$twitter);
$plant_bot = new PlantBot(@$state['plant'],$twitter);

$twitter->host = "https://api.twitter.com/1/";
$tweets_o = $twitter->get('statuses/friends_timeline',array('count' => 1400));

$mentions = $twitter->get('statuses/mentions',array('include_rts' => true));
foreach($mentions as $mention) {
    if(strtotime($mention->created_at) - @$state['users'][$mention->user->screen_name] > $one_day) {
        //echo "unsetting ",$mention->user->screen_name,"\n";
        $state['users'][$mention->user->screen_name]=0;
    }
}


$tweets = array_filter($tweets_o, function($tweet) {
    global $bad_words, $searches, $soundexs;

    $tweet->score=0;


    foreach($bad_words as $word) {
        $flag = (($word==strtolower($word))?"i":'');
        if(preg_match("/\s*#?$word\s*/$flag",$tweet->text) != false) {
            //echo "REJECT($word): ", $tweet->text,"\n";
            $tweet->score-=250;
            return false;
            break;
        }
    }

    $time = strtotime($tweet->created_at);

    if($tweet->retweeted) $tweet->score-=20;
    if(!$tweet->user->following) $tweet->score-=250;
    if($tweet->in_reply_to_screen_name) $tweet->score-=100;
    $tweet->score+=300*palindrome($tweet->text);
    $tweet->score+=3*min(30,$tweet->retweet_count);
    $tweet->score+=50*($tweet->text==strtoupper($tweet->text));
    $tweet->score+=70*($tweet->text==strtolower($tweet->text));
    $tweet->score+=100*(strtoupper($tweet->text)==strtolower($tweet->text));
    $tweet->score+=10*preg_match('/  /',$tweet->text);
    $tweet->score+=800*preg_match('/stolas/i',$tweet->in_reply_to_screen_name);
    $tweet->score-=1800*preg_match('/stolas/i',$tweet->user->screen_name);
    $tweet->score+=1800*preg_match('/Waffen_SS/i',$tweet->user->screen_name);
    $tweet->score+=40*preg_match('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', $tweet->text);
    $tweet->score+=130*($tweet->source!='web');
    $tweet->score+=0.003*min(10000,$tweet->user->statuses_count);
    $tweet->score+=0.03*min(1000,$tweet->user->favourites_count);
    $tweet->score-=20*$tweet->user->verified;
    $tweet->score+=15*count(array_intersect($soundexs,soundex_collect($tweet->text)));
    //echo "soundex count: ", count(array_intersect($soundexs,soundex_collect($tweet->text))),"\n";

    $ok = 0;

    foreach($searches as $word) {
        $flag = (($word==strtolower($word))?"i":'');
        if(preg_match("/\s*#?$word\s*/",$tweet->text) != false) {
            //echo "ACCEPT($word): ", $tweet->text,"\n";
            $tweet->score+=$ok?50:200;
            if($ok>4) {
                echo "stop gaming\n";
                print_r($tweet);
                return false;
            }
            $ok++;
        }
    }


    return $ok>0 || $tweet->score > 300;
    return $tweet->score>0;
});

$used=$outfit_bot->execute($tweets_o);
$state['outfit'] = $outfit_bot->state;
file_put_contents("$path/STATE",json_encode($state));

$stellar_bot->execute();
$state['stellar'] = $stellar_bot->state;
file_put_contents("$path/STATE",json_encode($state));

$plant_bot->execute();
$state['plant'] = $plant_bot->state;
file_put_contents("$path/STATE",json_encode($state));

$time_parts=localtime(time(),true);
$yes=false;
$allowed=false;

foreach($tweets as $tweet) {
    if(in_array($tweet,$used)) break;

    $user=$tweet->user->screen_name;
    $time = strtotime($tweet->created_at);
    $considerable=($time>@$state['consider'][$user]);
    $consider[$user]=max($time,@$consider[$user]);

    $difficulty = 1500
        + 1250 *( !@$state['consider'][$user] ) // be much less likely with new tweeters
        +  250 *( $yes&&$allowed ) // be less likely with sequential tweets
        -  200 *( time() - $state['time'] > $user_wait_time ) // be more likely if we havent succeeded in a while
        -  150 *( time() - $time <= 60 ) // be more likely if the tweet was in last 60 seconds
        -  100 *( time() - $time <= 300 ) // be more likely if the tweet was in last 5 min
        +  550 *( !in_array($time_parts['tm_wday'],array(0,6)) && in_array($time_parts['tm_hour'],range(6,20)) ) // be more difficult during work week
        -  750 *( in_array($time_parts['tm_hour'],range(0,4)) ) // more late night
        -  700 *( $time_parts["tm_mon"] == 11 && $time_parts['tm_mday'] == 1  )
        -  700 *( $time_parts["tm_mon"] == 10 && $time_parts['tm_mday'] >= 29  )
    ;
    $yes=$tweet->score > rand(0,$difficulty);

    $allowed=
        $time-@$state['users'][$user]>$user_wait_time &&
        time()-@$state['users'][$user]>$user_wait_time &&
        time()-$time<$user_wait_time;

    $txt = $magic->evolve($tweet->text,$tweet->score*($yes&&$allowed&&$considerable&&time()%2&&rand(0,1))); // only run evolve if we can post
    if(false && preg_match("/iOS|iPhone|Mac/",$tweet->source)) {
        $escaped = escapeshellarg($txt);
        $txt=chop(`echo $escaped | $path/gistfile1.pl`); // can't do shit
    }
    $status = '@'. $user." $txt";

    $params['status']=$status;
    $params=array(
        'in_reply_to_status_id'=>$tweet->id_str,
        'status'=>$status,
    );

    if($yes && strlen($status)<=140 && $allowed && $considerable){
            $used[]=$tweet;
            $state['users'][$user]=time();
            $twitter->post('statuses/update', $params); $state['time']=time();
    }

    file_put_contents("$path/STATE",json_encode($state));

    if(true&&$allowed/*&&$yes&&$considerable*/) {
        echo "DIFF=$difficulty,SCORE={$tweet->score},CONSIDER=$considerable,YES=$yes,ALLOW=$allowed\n";
        echo $tweet->user->screen_name, ":: ", $tweet->text,"\n";
        echo $status,"\n\n";
        //sleep(rand(60,120));
    }
    if($yes&&$allowed&&$considerable)
        sleep(5);

}
$state['consider']=$consider;
file_put_contents("$path/STATE",json_encode($state));
