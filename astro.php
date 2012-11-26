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
    public function generate()
    {
        $max=140;
        $str = self::COORDS;
        $str = `echo $str |astro  -olkc 1 2> /dev/null `;
        $rows = explode("\n",$str);
        array_shift($rows);
        array_pop($rows);
        foreach($rows as &$row) {
            $row = str_replace('Twilight starts','Dawn starts',$row);
            if(preg_match('/SAO (\d+)/',$row,$matches)) {
                $row = null;
            }
        }
        return array_filter($rows);
    }
}
