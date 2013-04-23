<?php
require_once('twitteroauth/twitteroauth/twitteroauth.php');
require_once('config.php');

$path = dirname(__FILE__);
$oTwitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

$aFollowing = $oTwitter->get('friends/ids');
$aFollowing = $aFollowing->ids;

$aFollowers = $oTwitter->get('followers/ids');
$aFollowers = $aFollowers->ids;

foreach( $aFollowing as $iFollowing )
{
	$isFollowing = in_array( $iFollowing, $aFollowers );

	echo "$iFollowing: ".( $isFollowing ? 'OK' : '!!!' )."<br/>";

	if( !$isFollowing )
	{
		$parameters = array( 'user_id' => $iFollowing );
		$status = $oTwitter->post('friendships/destroy', $parameters);
	}
}
