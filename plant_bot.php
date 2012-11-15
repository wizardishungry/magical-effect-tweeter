<?php
require_once('plant.php');
class PlantBot
{
    public $state;

    protected $twitter;

    const INTERVAL = 600;

    public function __construct($state,$twitter)
    {
        $this->state = $state;
        $this->twitter = $twitter;
    }

    public function execute()
    {
        $state = $this->state;
        $parts = getdate();
        $count=rand(-5,1);
        if(time()-$state>self::INTERVAL && ($parts['hours']>11||$parts['hours']<6)) {
            $plant = new Plant();
            for($i=$count;$i>0;$i--){
                $str = $plant->generate();
                echo "Plant $i $str\n";
                $params = array(
                    'status'=>$str,
                );
                $this->twitter->post('statuses/update', $params);
                $state=time();
            }
        }
        $this->state=$state;
    }

}
