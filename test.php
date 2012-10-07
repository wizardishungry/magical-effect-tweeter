<?php

require_once("magic.php");
require_once("lib.php");

$m = new Magic();

$s =  $m->evolve("up next: Dancin on theer snake and over until somebody makes me stop",0);
echo $s," ",strlen($s),"\n";
