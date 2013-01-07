<?php
require_once('stellar.php');
class StellarBot
{
    public $state;

    protected $twitter;

    const INTERVAL = 3700;

    public function __construct($state,$twitter)
    {
        $this->state = $state;
        $this->twitter = $twitter;
    }

    public function execute()
    {
        $state = $this->state;
        $parts = getdate();
        $count=rand(-5,2);
        if(time()-$this->state>self::INTERVAL && ($parts['hours']<7||$parts['hours']>=22)) {
            $state=time();
            $stellar = new Stellar();
            for($i=$count;$i>0;$i--){
                $array = $stellar->generate_a(!rand(0,2));
                foreach($array as $str) {
                    $params = array(
                        'status'=>$str,
                    );
                    if(!preg_match('/^http/',$str))
                        $this->twitter->post('statuses/update', $params);
                    sleep(5);
                }
                if($count>0)
                    $state+=.25*3600*$count;
            }
        }
        $this->state=$state;
    }

}
