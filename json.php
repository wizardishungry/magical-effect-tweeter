<?php
class Json
{

    const LENGTH_FRACTION = 0.6;
    protected $json;

    public function __construct()
    {
        $this->path = dirname(__FILE__);
    }

    protected function factoid($string, $max_length)
    {
        $sentences = $this->sentences($string);
        $best = '';
        for($count=0; $count<0.5*count($sentences)+1; $count++) { // just a rough estimate
            $idx = floor(sqrt(rand(0,pow(count($sentences)-1,2)))); // weight it a little towards low
            if($idx!=0 && ucfirst($sentences[$idx])!=$sentences[$idx] && $count<count($sentences))
                continue;
            $str = $sentences[$idx];
            $str = preg_replace("/^\W*$/",'',$str);
            while(strlen($str) < self::LENGTH_FRACTION * $max_length && $idx+1 < count($sentences) && rand(0,3))
            {
                $str .= ' '. $sentences[++$idx];
            }
            $str = $this->trim($str,$max_length);
            if($this->score($max_length,$str) < $this->score($max_length,$best))
                $best=$str;
        }
        return $best;
    }
    protected function score($max_length,$string)
    {
        return($max_length-strlen($string));
    }

    protected function trim($string,$max_length)
    {
        while(strlen($string)>$max_length) {
            $string = preg_replace("/ [^ ]*$/",'',$string);
        }

        return $string;
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
