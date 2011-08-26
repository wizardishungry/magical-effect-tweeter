<?
require_once('twitteroauth/twitteroauth/twitteroauth.php');

define('CONSUMER_KEY', 'insert_your_consumer_key_here');
define('CONSUMER_SECRET', 'insert_your_consumer_secret_here');
define('ACCESS_TOKEN', 'insert_your_access_token_here');
define('ACCESS_TOKEN_SECRET', 'insert_your_access_token_secret_here');

$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$twitter->host = "http://search.twitter.com/";
$ron = $twitter->get('search', array('q' => 'ron paul', 'rpp' => 40));
$gucci = $twitter->get('search', array('q' => 'gucci mane', 'rpp' => 40));

$bad_words = array(
  '[^\W]ash',
  'video',
  'ft.',
  'feat[. ]',
  'playin',
  'np',
  'lips',
  '^RT',
  '^@',
  'http',
  'song',
  'rapp',
  'nigger',
  'nigga',
  'ghetto',
  'chapstick',
  'via @',
  'pac man',
);
foreach(array(&$ron,&$gucci) as $a) {
    $a->results=array_filter($a->results, function($tweet) {
      global $bad_words; 
      foreach($bad_words as $word)
        if(preg_match("/$word/i",$tweet->text) != false)
        {
          //echo "EVICT: $word ", $tweet->text,"\n";
          return false;
        }
      return true;
    });
}

$twitter->host = "https://api.twitter.com/1/";
$tweets = array_merge($ron->results,$gucci->results);
shuffle($tweets);
shuffle($ron->results);
shuffle($gucci->results);
$used=array();

foreach($tweets as $tweet) {
  if(in_array($tweet,$used)) break;

  $state=0;
  if(preg_match('/@yeahok/',$tweet->text)|| preg_match('/@yeahok/',$tweet->from_user)) {
    $txt=preg_replace(Array('/Ron Paul/i', '/Gucci Mane/i','/GucciDoinThings/i','/@gucci1017/i','/librrrtarian/i'), Array('state', 'state','yeahok','@yeahok','@yeahok','McDonaldsCorp'), $tweet->text);
    $state=-1;
  } else {
    $state=rand(0,10);
    $txt=preg_replace(Array('/Ron Paul/i','/Gucci Mane/i'), Array('GMGMGMGM', 'RPRPRPRP'), $tweet->text);
    $txt=preg_replace(Array('/GMGMGMGM/', '/RPRPRPRP/','/GucciDoinThings/'), Array('Gucci Mane', 'Ron Paul','RonPaul'), $txt);
  }

  $is_ron = in_array($tweet,$ron->results);
  $params=array(
    //'in_reply_to_status_id'=>$tweet->id_str
  );

  $target=null;
  $user=$tweet->from_user;
  //echo "STATE $state is ron $is_ron \n";
  switch($state) {
    case 0:
    case 1:
      // false retweet, pop someone from other column
      $target=!$is_ron?@$ron->results[0]:@$gucci->results[0];
      if(!$target) {
        /*echo "SKIP1\n";*/ continue 2;
      }
      $user=$target->from_user;
      // fall through
    case -1:
    case 2:
      // default, just swap txt
      if(preg_match('/^\w*@/',$txt)) { // don't RT @replies
         /*echo "SKIP3 \"$txt\"\n";*/  continue 2;
      }
      $status = 'RT @'.$user.' '.$txt;
      $target=$tweet;
      break;
    default:
      // @reply to tweet from other column
      $target=!$is_ron?@$ron->results[0]:@$gucci->results[0];
      if(!$target) {
        /*echo "SKIP2\n";*/ continue 2;
      }
      $params['in_reply_to_status_id']=$target->id_str;
      $status = '@'. $target->from_user." $txt";
      //echo "REPLYTO ",$target->from_user, ":: ", $target->text,"\n";
  }

  if( strlen($status)<=140 && ((!preg_match('/librrrtarian/i',$status)
    &&!preg_match('/Now Playin/i',$txt)&&!preg_match('/NowPlayin/i',$txt)
    &&!preg_match('/http/i',$txt)
    &&!preg_match('/RT /i',$txt) &&!preg_match('/[ #]np/i', $txt)&&!preg_match('/bot/i',$status))||$state==-1))
  {
    $used[]=$target;
    $used[]=$tweet;
    $params['status']=$status;
    $twitter->post('statuses/update', $params);
    //print_r($tweet); exit;
    //echo $tweet->from_user, ":: ", $tweet->text,"\n";
    //echo $status,"\n";

    if($target) {
      if(!$is_ron)
        $ron->results=array_slice($ron->results,1);
      else
        $gucci->results=array_slice($gucci->results,1);
    }

    sleep(rand(60,120));
    //sleep(5);
  }
}
