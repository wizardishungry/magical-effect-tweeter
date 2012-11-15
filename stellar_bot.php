<?php
require_once('stellar.php');
class StellarBot
{
    public $state;

    protected $twitter;

    const INTERVAL = 3600;

    public function __construct($state,$twitter)
    {
        $this->state = $state;
        $this->twitter = $twitter;
    }

    public function execute()
    {
        $state = $this->state;
        $parts = getdate();
        $count=rand(-5,3);
        $state=time();
        if(time()-$this->state>self::INTERVAL && ($parts['hours']<7||$parts['hours']>=23)) {
            $stellar = new Stellar();
            for($i=$count;$i>0;$i--){
                $str = $stellar->generate(!rand(0,2));
                echo "STELLAR $i $str\n";
                $params = array(
                    'status'=>$str,
                );
                $this->twitter->post('statuses/update', $params);
                if($count>0)
                    $state+=.25*3600*$count;
            }
        }
        $this->state=$state;
    }

}
