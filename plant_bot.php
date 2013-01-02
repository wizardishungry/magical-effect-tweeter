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
        $count=rand(-10,1);
        if(time()-$this->state>self::INTERVAL && ($parts['hours']>=8&&$parts['hours']<=18)) {
            echo "in pl loop\n";
            $plant = new Plant();
            for($i=$count;$i>0;$i--){
                $array = $plant->generate_a(!rand(0,1));
                foreach($array as $str) {
                    echo "Plant $str\n";
                    $params = array(
                        'status'=>$str,
                    );
                    if(!preg_match('/^http/',$str))
                        $this->twitter->post('statuses/update', $params);
                    sleep(5);
                }
            }
            $state=time();
        }
        $this->state=$state;
    }

}
