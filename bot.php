<?
require_once('twitteroauth/twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'insert_your_consumer_key_here');
define('CONSUMER_SECRET', 'insert_your_consumer_secret_here');
define('ACCESS_TOKEN', 'insert_your_access_token_here');
define('ACCESS_TOKEN_SECRET', 'insert_your_access_token_secret_here');

$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$twitter->host = "http://search.twitter.com/";
$ron = $twitter->get('search', array('q' => 'ron paul', 'rpp' => 20));
$gucci = $twitter->get('search', array('q' => 'gucci mane', 'rpp' => 20));

$twitter->host = "https://api.twitter.com/1/";
$tweets = array_merge($ron->results,$gucci->results);
shuffle($tweets);
foreach($tweets as $tweet) {
  $txt=preg_replace(Array('/Ron Paul/i','/Gucci Mane/i'), Array('GMGMGMGM', 'RPRPRPRP'), $tweet->text);
  $txt=preg_replace(Array('/GMGMGMGM/', '/RPRPRPRP/'), Array('Gucci Mane', 'Ron Paul'), $txt);
	$status = 'RT @'.$tweet->from_user.' '.$txt;
  if( strlen($status)<=140 && !preg_match('/librrrtarian/i',$status)&&!preg_match(array('/RT /i','/#np/i'), $txt)&&!preg_match('/bot/i',$status))
  {
      $twitter->post('statuses/update', array('status' => $status));
    //echo $tweet->text,"\n";
    echo $status,"\n";
    sleep(rand(60,120));
  }
}
