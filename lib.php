<?php
function palindrome($a)
{
    $a=preg_replace('#\W#','',strtolower($a));
    $b=strrev($a);
    return ($a==$b);
}
