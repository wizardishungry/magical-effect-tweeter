<?php
require_once('json.php');
require_once('stellar.php');
class Astro extends Json
{
    const COORDS = "40.77 73.98 10"; //nlat wlong elev
    protected $stellar;
    public function __construct()
    {
        list($lat,$long,$elev)=explode(" ",self::COORDS);
        ini_set("date.default_latitude", $lat);
        ini_set("date.default_longitude", -$long);
        date_default_timezone_set('America/New_York');
        //$this->stellar = new Stellar();
    }
    public function generate($now=null)
    {
        if($now==null) {
            $now = time();
        }
        $max=140;
        $str = self::COORDS;
        $str = `echo $str |astro  -olkc 1 -C 0.5 2> /dev/null | grep -vi comet `;
        $rows = explode("\n",$str);
        array_shift($rows);
        array_pop($rows);
        foreach($rows as &$row) {
            $row = str_replace('Twilight starts','Dawn starts',$row);
            if(FALSE && preg_match('/SAO (\d+)/',$row,$matches)) {
                $row = null;
            }
        }
        $output = array();
        foreach (array_filter($rows) as $v){
            if(preg_match('/ at (.*)/',$v,$matches)) {
                $str = preg_replace('/:\d\d .*$/','',$matches[1]);
                $k = strtotime($str,$now);
                if($k<$now) {
                    $k = strtotime($str,strtotime(' tomorrow',$now));
                }
            }
            else {
                $k = time();
            }
            $output[$k]=$v;
        }

        $output = $output + $this->comet();

        return $output;
    }
    public function comet()
    {
        $path = dirname(__FILE__);
        $str = `python2.6 $path/comet/ison.py 2> /dev/null `;
        $rows = explode("\n",$str);
        $time = time();
        $output = array();
        $value = '';
        foreach($rows as $row)
        {
            if(preg_match('#C/2012#',$row)) {
                $value = "Comet $row";
            }
            if(preg_match('#transit#',$row)) {
                $time = strtotime(preg_replace('/^.*: /','',$row));
            }
        }
        if($value)
            $output[$time] = $value;
        return $output;
    }
}
