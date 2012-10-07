<?php
function palindrome($a)
{
    $a=preg_replace('#\W#','',strtolower($a));
    $b=strrev($a);
    return ($a==$b);
}

function soundex_collect($str) {
    $a = array();
    foreach(explode(" ",$str) as $word) {
        if(strlen($word)>4) {
            $s=soundex($word);
            $a[$s]=$s;
        }
    }
    return $a;
}
