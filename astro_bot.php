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
        $state = $this->state;
        $astro = new Astro();
        if(time() > date_sunset(time(),SUNFUNCS_RET_TIMESTAMP) && time()-$state > 0.75*self::INTERVAL) {
            $strings = $astro->generate();
            foreach($strings as $str) {
                $params = array(
                    'status'=>$str,
                );
                $this->twitter->post('statuses/update', $params);
                sleep(rand(15,55));
            }
            $state=time();
        }
        else
        {
            echo "wait till after sunset!\n";
        }
        $this->state=$state;
    }

}
