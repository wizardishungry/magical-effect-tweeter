<?php
class Stellar
{

    const LENGTH_FRACTION = 0.6;
    protected $json, $ok;

    public function __construct()
    {
        $this->ok = false;
        $path = dirname(__FILE__);
        $json=file_get_contents("$path/stellar-database.json");
        if($json===FALSE) return;
        $json=json_decode($json,true);
        if($json===FALSE) return;
        //print_r($json);exit;
        $this->json=$json;
        $this->path=$path;
        $this->ok=true;
    }

    public function generate()
    {
        if(!$this->ok) return;
        $star = $this->seek();

        $poe = $star['points_of_interest'];
        foreach(array_rand($star,rand(2,min(2,count($star)))) as $key) {
            if(is_string($star[$key])) {
                $poe .= " {$star[$key]}.";
            }
        }

        $names = array();
        if(isset($star['catalog_numbers'])) $names = $star['catalog_numbers'];
        $poe .= ' '. $names[array_rand($names)];
        $names[] = $star['name'];
        $names[] = $star['name'];
        $names[] = $star['name'];
        $name = $names[array_rand($names)];

        $poe = preg_replace("/^$name /", '', $poe);
        $poe = preg_replace("/^{$star['name']} /", '', $poe);

        $str = $name .': ';
        //print_r($star);exit;

        $poe= preg_replace('/ and /', ' & ',$poe);
        $str.=$this->factoid($poe,140-strlen($str));
        $str = preg_replace('/  /', ' ',$str);
        $str = preg_replace('/ [.]/', ' .',$str);
        $str= preg_replace('/ and /', ' & ',$str);
        return $str;
    }

    protected function factoid($string, $max_length)
    {
        $sentences = $this->sentences($string);
        $best = '';
        for($count=0; $count<2*count($sentences)+1; $count++) { // just a rough estimate
            $idx = floor(sqrt(rand(0,pow(count($sentences)-1,2)))); // weight it a little towards low
            if($idx!=0 && ucfirst($sentences[$idx])!=$sentences[$idx] && $count<count($sentences))
                continue;
            $str = $sentences[$idx];
            while(strlen($str) < self::LENGTH_FRACTION * $max_length && $idx+1 < count($sentences) && rand(0,3))
            {
                $str .= ' '. $sentences[++$idx];
            }
            $str = $this->trim($str,$max_length);
            if($max_length-strlen($str) < $max_length-strlen($best))
                $best=$str;
        }
        return $best;
    }

    protected function trim($string,$max_length)
    {
        while(strlen($string)>$max_length) {
            $string = preg_replace("/ [^ ]*$/",'',$string);
        }

        return $string;
    }

    protected function seek()
    {
        for($count=0; $count<1000; $count++) {
            $star = $this->json[array_rand($this->json)];
            if(isset($star['points_of_interest']))
                return $star;
        }
        return;
    }

    protected function sentences($string) {
        $parts = preg_split('/([.?!:])/', $string, -1, PREG_SPLIT_DELIM_CAPTURE);
        $sentences = array();
        for ($i=0, $n=count($parts)-1; $i<$n; $i+=2) {
            $sentences[] = $parts[$i].$parts[$i+1];
        }
        if ($parts[$n] != '') {
            $sentences[] = $parts[$n];
        }
        return $sentences;
    }
}
