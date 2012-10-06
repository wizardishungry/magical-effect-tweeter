<?php
require_once('twitteroauth/twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('magic.php');

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
  'Rush',
  'stolas',
  'Stolas_REAL',
);

$searches = array(
  //  '"magic underwear"',
    '"roll the bones"',
    'kolob',
    '"blood oath"',
    '"would sell my soul for"',
);

$wait_time = 86400;

/////////////////////////////////////////////////////////////////////////////////////////
date_default_timezone_set('America/New_York');

$path = dirname(__FILE__);
$state = json_decode(@file_get_contents("$path/STATE"), true);
if(!$state) {
    $state = array(
        'time'=>0,
        'users'=>array(),
    );
}
$state['time']=time();

$magic = new Magic();
$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$twitter->host = "http://search.twitter.com/";


$results = array();

foreach($searches as $search) {
    $r = $twitter->get('search', array('q' => $search, 'rpp' => 40));
    $results[]=$r;
}

foreach($results as $a) {
    $a->results=array_filter($a->results, function($tweet) {
      global $bad_words;
      foreach($bad_words as $word)
        if(preg_match("/$word/i",$tweet->text) != false)
        {
          //echo "REJECT($word): ", $tweet->text,"\n";
          return false;
        }
      return true;
    });
}

$tweets = array();
foreach($results as $result) {
    $tweets = array_merge($tweets,$result->results);
}
shuffle($tweets);

$twitter->host = "https://api.twitter.com/1/";
$used=array();

foreach($tweets as $tweet) {
  if(in_array($tweet,$used)) break;


  $params=array(
    'in_reply_to_status_id'=>$tweet->id_str
  );

  $txt = $magic->generate();
  $user=$tweet->from_user;
  $status = '@'. $user." $txt";
  $params['status']=$status;
  $time = strtotime($tweet->created_at);

  if(strlen($status)<=140 && $time-@$state['users'][$user]>$wait_time && time()-@$state['users'][$user]>$wait_time ){
    $yes = true;
    $used[]=$tweet;
    $state['users'][$user]=time();
    file_put_contents("$path/STATE",json_encode($state));
    $twitter->post('statuses/update', $params);
    sleep(rand(60,120));
    //sleep(5);
  }
  else {
    $yes = false;
  }

  if($yes) {
    echo ' ', $tweet->from_user, ":: ", $tweet->text,"\n";
    echo $status,"\n\n";
  }

}
