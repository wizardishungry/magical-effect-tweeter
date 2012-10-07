<?php

require_once("magic.php");
require_once("lib.php");

$m = new Magic();
echo $m->generate(),"\n";

echo "::", palindrome("a   "),"\n";
echo "::", palindrome("No won wonky, as I say, know now on."),"\n";
