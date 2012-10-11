<?php
require_once('outfit.php');
class OutfitBot
{
    public $state;

    const INTERVAL = 86400;

    protected $patterns = array(
        'should i wear',
        'do i wear',
        "i'?m wearing",
        "Taken with Instagram",
    );

    public function __construct($state,$twitter)
    {
        $this->state = $state;
        $this->twitter = $twitter;
    }

    public function execute($tweets)
    {
        $state = $this->state;
        $outfit = new Outfit;

        $used = array();
        foreach($tweets as $tweet) {
            foreach($this->patterns as $pattern) {
                if($tweet->score >= 0 && $tweet->score < 300 && preg_match("/$pattern/i",$tweet->text)) {
                    $used[$tweet->text]=$tweet;
                }
            }
        }

        foreach($used as $tweet) {
            $txt = $outfit->generate();
            $user=$tweet->user->screen_name;
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
