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

    public function generate($withImage=false)
    {
        $max = 140;
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
        if(strlen($json['medicinal'])>10)
            $poe.= " ". $json['medicinal'];
        if(strlen($json['known_hazards'])>10)
            $poe.= " ". $json['known_hazards'];
        $poe = str_replace("\r", "", $poe);
        $poe = str_replace("\n", " ", $poe);
        $poe = preg_replace('/ ?None known/i','',$poe);
        $poe = preg_replace('/ ?Not known/i','',$poe);
        $poe = preg_replace('/\[[\d\s\w, ]*\]/','',$poe);

        $names = array();
        if($json['common_name']) {
            $names[] = $json['common_name'];
            $names[] = $json['common_name'];
            $names[] = "{$json['common_name']} ({$json['latin_name']})";
        }
        $names[] = $json['latin_name'];
        $name = $names[array_rand($names)];
        if($withImage) {
            $image = $this->getImage($names[array_rand($names)]);
            if($image)
                $max = 119;
        }


        $poe = preg_replace("/^$name /", '', $poe);

        $str = $name .': ';

        $poe= preg_replace('/ and /', ' & ',$poe);
        $str.=$this->factoid($poe,$max-strlen($str));
        $str = preg_replace('/  /', ' ',$str);
        $str = preg_replace('/ [.]/', ' .',$str);
        $str = preg_replace('/ [,]/', ' ,',$str);
        $str= preg_replace('/ and /', ' & ',$str);

        if(isset($image))
            $str .= " $image";
        return $str;
    }

    protected function score($max_length,$string)
    {
        return parent::score($max_length,$string)-
        20*preg_match('/poison/i',$string)-
        50*preg_match('/halluci/i',$string)-
        10*preg_match('/mydriatic/i',$string)-
        10*preg_match('/analgesic/i',$string)-
        10*preg_match('/vomit/i',$string)-
        10*preg_match('/hypnotic/i',$string)-
        20*preg_match('/narcotic/i',$string)-
        20*preg_match('/sedative/i',$string)-
        20*preg_match('/spasmodic/i',$string)
        ;
    }
}
