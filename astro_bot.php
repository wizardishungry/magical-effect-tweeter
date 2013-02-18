<?php
require_once('astro.php');
class AstroBot
{
    public $state;

    protected $twitter;

    const INTERVAL = 86400; // one day

    public function __construct($state,$twitter)
    {
        $this->state = $state;
        $this->twitter = $twitter;
    }

    public function execute()
    {
        $this->daily();
        $new_strings=array();
        foreach($this->state['strings'] as $time => $str) {
            if($time<=time()) {
                $params = array(
                    'status'=>$str,
                );
                $this->twitter->post('statuses/update', $params);
            }
            else {
                $new_strings[$time]=$str;
            }
        }
        $this->state['strings']=$new_strings;
    }
    public function daily()
    {
        $astro = new Astro();
        if(time() > date_sunset(time(),SUNFUNCS_RET_TIMESTAMP)-3600 && time()-$state['time'] > 0.5*self::INTERVAL) {
            $strings = $astro->generate();
            $this->state['time']=time();
            $this->state['strings']=$strings;
        }
        else
        {
            echo "wait till after sunset to generate!\n";
        }
    }
}
