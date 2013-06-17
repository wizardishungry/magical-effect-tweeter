<?php
error_reporting(E_ALL);
ini_set('memory_limit', '2048M');
// http://mochakimono.chipx86.com/agen2.html;
abstract class Base
{

    protected $aCheckArray;
    protected $aCheckText;
    protected $aItemWords;
    protected $aItemCodes;
    protected $aItemCodesMemoized;

    //Regular functions;

    protected function getNumber($aCurrArray, $intCheckNumber)
    {
        $intReturn; $intLooper;
        $bEnd=false;
        $count = 0;

        while ($bEnd==false && $count++<1000000000)
        {
            $intReturn=rand(0,count($this->aItemCodes)-1);

            if (($this->aItemCodes[$intReturn]  &  $intCheckNumber)==$intCheckNumber)
            {
                $bEnd=true;
            }

            for ($intLooper=0;$intLooper<count($aCurrArray);$intLooper++)
            {
                if ($aCurrArray[$intLooper]==$intReturn)
                {
                    $bEnd=false;
                }
            }
        }

        if(!$bEnd) {
            throw new Exception("Trying to locate mask $intCheckNumber failed; " . count($this->aItemCodes)." items.");
        }
        return $intReturn;
    }

    protected function getNumber2($aCurrArray, $intCheckNumber)
    {
        if(!isset($this->aItemCodesMemoized)||!isset($this->aItemCodesMemoized[$intCheckNumber])) {
            if(!isset($this->aItemCodesMemoized)) {
                $this->aItemCodesMemoized=array();
            }
            foreach($this->aItemCodes as $idx => $code) {
                if(!isset($this->aItemCodesMemoized[$code])) {
                    $this->aItemCodesMemoized = array();
                }
                $this->aItemCodesMemoized[$code][] = $idx;
            }
        }
        //////
        $bEnd = false;
        while($bEnd==false) {
            $intReturn = $this->aItemCodesMemoized[$intCheckNumber][array_rand($this->aItemCodesMemoized[$intCheckNumber])];


            if (($this->aItemCodes[$intReturn]  &  $intCheckNumber)==$intCheckNumber) {
                $bEnd=true;
            }

            for ($intLooper=0;$intLooper<count($aCurrArray);$intLooper++) {
                if ($aCurrArray[$intLooper]==$intReturn) {
                    $bEnd=false;
                }
            }

        }
        return $intReturn;
    }


    public function generate()
    {
        $aUseNumber=array();
        $intArrayUse;
        $strReturn="";
        $strPass;
        $intNumber=-1;
        $intLooper;
        $bEnd = false;

        $intArrayUse=rand(0, count($this->aCheckArray)-1);

        for ($intLooper=0;$intLooper<count($this->aCheckArray[$intArrayUse]);$intLooper++)
        {
            $aUseNumber[$intLooper]=-1;
        }

        for ($intLooper=0;$intLooper<count($this->aCheckArray[$intArrayUse]);$intLooper++)
        {
                        $intNumber=$this->getNumber($aUseNumber,$this->aCheckArray[$intArrayUse][$intLooper]);
                        $aUseNumber[$intLooper]=$intNumber;
        }

        $strReturn = $this->aCheckText[$intArrayUse][0];

        for ($intLooper=0;$intLooper<count($aUseNumber);$intLooper++)
        {
            if ($aUseNumber[$intLooper]>-1)
            {
                $strReturn.= $this->aItemWords[$aUseNumber[$intLooper]];
                $strReturn.= $this->aCheckText[$intArrayUse][$intLooper+1];
            }
        }

        return trim($strReturn);
    }

    public function evolve($input, $rounds = 1)
    {
        $output= '';
        $score = -1000;
        $rounds=max(1,$rounds);

        //echo "EVOLVE($rounds): $input = ";

        $input_set=soundex_collect($input);

        for($i=0;$i<$rounds;$i++) {
            $newstr = $this->generate();
            $newset=soundex_collect($newstr);
            $newscore = 12.3*count(array_intersect($newset,$input_set)) -2*(strlen($newstr)>70) -6*(strlen($newstr)>130) +2*(strlen($newstr)>30);
            if($newscore>$score) {
                $score=$newscore;
                $output=$newstr;
            }
        }

        return $output;
    }

    public function __construct()
    {
        $this->path = dirname(__FILE__);
    }

    protected function moreColors($idx)
    {
        $colors = file(dirname(__FILE__)."/colors.txt",FILE_SKIP_EMPTY_LINES);
        array_walk($colors, function(&$color) {
            $color = strtolower($color);
            $color = preg_replace('/ \(.*/', '', $color);
            $color = chop($color);
        });
        $colors = array_unique($colors);
        foreach($colors as $color) {
            $this->aItemWords[] = $color;
            $this->aItemCodes[] = $idx;
        }
        return $colors;
    }

    protected function moreMonsters($idx, $colors)
    {
        $monsters = file(dirname(__FILE__)."/monsters.txt",FILE_SKIP_EMPTY_LINES);
        $monsters += file(dirname(__FILE__)."/pokemon.txt",FILE_SKIP_EMPTY_LINES);

        $monsters = array_unique($monsters);
        $new_monsters = array();
        foreach($monsters as &$monster) {
            $monster = chop($monster);
            $parts = explode(' ', $monster);
            foreach($parts as $k => $part) {
                if(in_array($part,$colors)) {
                    foreach($colors as $color) {
                        $new_monsters[] = implode(' ', array_merge(array_slice($parts,0,$k) , array($color) , array_slice($parts, $k+1)));
                    }
                }
                else {
                    foreach($colors as $color) {
                        $new_monsters[] = (rand(0,10)==0?"$color ":'') . $monster; // fixme magic number
                    }
                }
            }
        }
        $monsters += $new_monsters;

        foreach($monsters as $monster) {
            $monster = strtolower($monster);
            if($idx==1) {
                $monster = "You turn into a $monster";
            }
            $this->aItemWords[] = $monster;
            $this->aItemCodes[] = $idx;
        }
    }

    public function dumpJson() {
        $nums = $this->aCheckArray;
        $words = $this->aCheckText;
        return json_encode(
            array_map(function($nums,$words)
            {
                $output = array();
                while(NULL !== $str = array_shift($words)) {
                    if($str === "")
                        $str = ' ';
                    if(NULL !== $num = array_shift($nums)) {
                        $str.= "\\$num";
                    }
                    $output[] =$str;
                }
                return trim(implode('',array_filter($output)));
            },
            $nums, $words)
        );
    }
}
