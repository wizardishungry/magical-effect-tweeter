<?php
require_once('deps.php');


$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
//$twitter->host = "https://api.twitter.com/1/";

function usage() {
    global $argv;
    echo "Usage: php {$argv[0]} {Magic,Outfit} https://twitter.com/USER/status/666 [Y]\n";
    echo "       [Y] autoposts\n";
    exit(1);
}

if(count($argv) < 3) {
    usage();
}
$url = $argv[2];
$class = $argv[1];
$cmd = @$argv[3];

$bits = parse_url($url);
if(!$bits) {
    die("$url is not url");
}

list(,$user,$module,$id) = explode('/',$bits['path']);
//echo "$user $module $id\n";

$o = new $class;

do {
    if($cmd=='q') {
        exit();
    }
    $txt = $o->generate();
    $status = '@'. $user." $txt";
    echo str_repeat("*",140), "\n","$status\n";

    $params=array(
        'in_reply_to_status_id'=>$id,
        'status'=>$status,
    );
    //print_r($params);
    if($cmd != 'y' && $cmd != 'Y') {
        $cmd = readline("Post [n]? ");
    }
} while($cmd != 'y' && $cmd != 'Y');

$twitter->post('statuses/update', $params);
