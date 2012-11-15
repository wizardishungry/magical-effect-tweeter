<?php
require_once('json.php');
class Plant extends Json
{

    protected $json;

    public function __construct()
    {
        parent::__construct();
        $this->path.="/plantsdb"; // sorry jgv
    }

    public function generate()
    {
        $path=$this->path;
        $files = glob("$path/*.json");
        $idx = array_rand($files);
        $json=file_get_contents($files[$idx]);
        if($json===FALSE) return;
        $json=json_decode($json,true);
        if($json===FALSE) return;

        $poe = $json['cultivation_details'];
        $poe.= " ". $json['habitat'];
        $poe.= " ". $json['propagation_1'];
        $poe.= " ". $json['uses_notes'];
        $poe.= " ". $json['edible_uses'];
        if(strlen($json['medicinal']))
            $poe.= " ". $json['medicinal'];
        $poe = str_replace("\r", "", $poe);
        $poe = str_replace("\n", " ", $poe);
        $poe = preg_replace('/ ?None known ?/','',$poe);
        $poe = preg_replace('/\[[\d\s\w, ]*\]/','',$poe);

        $names = array();
        if($json['common_name']) {
            $names[] = $json['common_name'];
            $names[] = $json['common_name'];
        $names[] = "{$json['common_name']} ({$json['latin_name']})";
        }
        $names[] = $json['latin_name'];
        $name = $names[array_rand($names)];

        $poe = preg_replace("/^$name /", '', $poe);

        $str = $name .': ';

        $poe= preg_replace('/ and /', ' & ',$poe);
        $str.=$this->factoid($poe,140-strlen($str));
        $str = preg_replace('/  /', ' ',$str);
        $str = preg_replace('/ [.]/', ' .',$str);
        $str = preg_replace('/ [,]/', ' ,',$str);
        $str= preg_replace('/ and /', ' & ',$str);
        return $str;
    }

    protected function score($max_length,$string)
    {
        return parent::score($max_length,$string)-10*preg_match('/poison/i',$string);
    }
}
