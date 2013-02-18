<?php
require_once('twitteroauth/twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('magic.php');
require_once('lib.php');
require_once('outfit_bot.php');
require_once('stellar_bot.php');
require_once('astro_bot.php');
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
        'alien'=>array(),
        'stellar'=>0,
        'astro'=>0,
        'plant'=>0,
    );
}

$state_prefixes = array('consider','outfit');
$fun=array(
    "242afec37be317ec2ad26d5f1460488fec7f25c8",
    "e818445223cfe518f33b892b124af8ddcc2868ff",
    '9803b66e314499c03e90fc34f16c44e687083812',
    '7ef4a0cbb635cbcf82f3923427531060c78f15a6',
    "25e994e9943af36a63b597ea61dc3392215d0d1e",
    '558fc6d832c6482aa50b6252d163377915aa01e8',
    '02162649fee61841d4f60c698e975d5728222b0b',
    'd4c35a9ac46efb14e9e1458b33e00bb47a86f603',
    "ca25e721695438042be77c71860e6e7ea0a96c86",
    '44431deb70c9183793a264cb692cafd1452b0d6a',
    'f515553b376d4baf5789caf8992fc80ee8964fd8',
    '717e5de1c64b4bc411ac341684c363745204819d',
    '327538e175436c7d697b910631bcc964d84b2643',
    "0655d865738f91fc7747763eac30ccfc8c3dc728",
    "65ff2ea15c6b3255090fe54a5c9a59b095c19903",
    "02162649fee61841d4f60c698e975d5728222b0b",
    "432cd9362785f5fe1c5552e72b1c75b003a66936",
    "1bcb7336ab1f8466f3308207abbb7199cf8f322d",
    "d1197c3a7d5be55070ffe3413a3c99ee2f54505b",
    'df539854aadbdce620f16e49bb9c5e430009c114',
    "e02269904bb8457cb5862d023a0bb966cf38a268",
    "fa9c607e2715ec5ff5ccf1b13b9796ab9140ef08",
    "3f37a70e79174f0e256340a09b6889b612349895",
    "f13873f978ca6ce3f0bafc33e2e55dcd0c44343b",
    "d4d4b59e2de89778038c33846091a15db0eecc94",
    "89e73d4913d71b92b92c2352f9a021a694a68a63",
    "a58ed94ec6d6694b1e8ce21e8e18e07b8ece8705",
    "5120636f96ac56c15b3232d62a0c81c16b09521b",
    "0a9a7d57cf48f14b45d48eb864b73afdda39e869",
    "9f48bca8c59a71af5542998165bce0a9283b1b85",
    "e0b6489cccd8d95d0e800efb17a8744720218011",
);
foreach($state_prefixes as $prefix) {
    foreach($state[$prefix] as $user => &$time) {
        $s = sha1($user);
        if(in_array($s,$fun)) {
            $time = 0;
        }
    }
}


$consider=$state['consider'];

$magic = new Magic();
$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$outfit_bot = new OutfitBot(@$state['outfit'],$twitter);
$stellar_bot = new StellarBot(@$state['stellar'],$twitter);
$astro_bot = new AstroBot(@$state['astro'],$twitter);
$plant_bot = new PlantBot(@$state['plant'],$twitter);

$twitter->host = "https://api.twitter.com/1/";
$tweets_o = $twitter->get('statuses/friends_timeline',array('count' => 140));

$mentions = $twitter->get('statuses/mentions',array('include_rts' => true));
foreach($mentions as $mention) {
    if(strtotime($mention->created_at) - @$state['users'][$mention->user->screen_name] > $one_day) {
        //echo "unsetting ",$mention->user->screen_name,"\n";
        $state['users'][$mention->user->screen_name]=0;
    }
    if(preg_match('/alien|skull|boxes|👽|dfkgjjkdfgd/', $mention->text)) {
        $state['alien'][$mention->user->screen_name]=1;
    }
}


$tweets = array_filter($tweets_o, function($tweet) {
    global $bad_words, $searches, $soundexs, $fun;

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

    if($tweet->retweeted) $tweet->score+=220;
    if(!$tweet->user->following) $tweet->score+=250;
    if($tweet->in_reply_to_screen_name) $tweet->score+=100;

    $tweet->score+=300*palindrome($tweet->text);
    $tweet->score+=3*min(30,$tweet->retweet_count);
    $tweet->score+=50*($tweet->text==strtoupper($tweet->text));
    $tweet->score+=70*($tweet->text==strtolower($tweet->text));
    $tweet->score+=100*(strtoupper($tweet->text)==strtolower($tweet->text));
    $tweet->score+=10*preg_match('/  /',$tweet->text);
    $tweet->score+=800*preg_match('/stolas/i',$tweet->in_reply_to_screen_name);
    $tweet->score-=1800*preg_match('/stolas/i',$tweet->user->screen_name);
    $s = sha1($tweet->user->screen_name);
    if(in_array($s,$fun)) {
        $tweet->score+=1800;
    }
    $tweet->score+=240*preg_match('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', $tweet->text);
    $tweet->score+=130*($tweet->source!='web');

    $tweet->score+=30*min(10000,$tweet->user->statuses_count);
    $tweet->score+=30*min(1000,$tweet->user->favourites_count);

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

$astro_bot->execute();
$state['astro'] = $astro_bot->state;
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
        -  1700 *( $time_parts["tm_mon"] == 12 && $time_parts['tm_mday'] >= 21  ) // 2012
    ;
    ;
    $yes=$tweet->score > rand(0,$difficulty);

    $allowed=
        $time-@$state['users'][$user]>$user_wait_time &&
        time()-@$state['users'][$user]>$user_wait_time &&
        time()-$time<$user_wait_time;

    $txt = $magic->evolve($tweet->text,min(1000*$tweet->score,10000)*($yes&&$allowed&&$considerable&&time()%2&&rand(0,1))); // only run evolve if we can post
    if(preg_match("/iOS|iPhone|Mac/",$tweet->source) && rand(0,10)==0 && !@$state['alien'][$tweet->user->screen_name]) {
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
