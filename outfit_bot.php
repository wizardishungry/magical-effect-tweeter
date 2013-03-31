<?php
require_once('outfit.php');
class OutfitBot
{
    public $state;

    //const INTERVAL = 86400;
    const INTERVAL = 604800; // one week

    protected $patterns;

    public function __construct($state,$twitter)
    {
        $this->state = $state;
        $this->twitter = $twitter;
        $path = dirname(__FILE__);
        $flags=FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES;
        $this->patterns = file("$path/outfit.txt",$flags);
        $this->path=$path;
    }

    public function execute($tweets)
    {
        $state = $this->state;
        $outfit = new Outfit;

        $used = array();
        foreach($tweets as $tweet) {
            foreach($this->patterns as $pattern) {
                if($tweet->score >= 0 && $tweet->score > 6000 && !rand(0,5) && preg_match("@ +$pattern +@i",$tweet->text)) {
                    $used[$tweet->text]=$tweet;
                    echo $pattern," ^ {$tweet->score} ",$tweet->text,"\n";
                }
            }
        }

        foreach($used as $tweet) {
            $txt = $outfit->generate();
            $user=$tweet->user->screen_name;
            $path=$this->path;
            if(false && preg_match("/iOS|iPhone|Mac/",$tweet->source)) {
                $escaped = escapeshellarg($txt);
                $txt=chop(`echo $escaped | $path/gistfile1.pl`); // can't do shit
            }

            $status = '@'. $user." $txt";
            $time = strtotime($tweet->created_at);
            if($time-@$state[$user]>static::INTERVAL) {
                $params=array(
                    'in_reply_to_status_id'=>$tweet->id_str,
                    'status'=>$status,
                );
                if(strlen($params['status'])<=140) {
                    $this->twitter->post('statuses/update', $params);
                    $state[$user]=$time;
                }
            }
        }

        $this->state = $state;
        return $used;
    }

}
