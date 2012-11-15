<?php

require_once("magic.php");
require_once("outfit.php");
require_once("stellar.php");
require_once("plant.php");
require_once("lib.php");

$m = new Magic();
$o = new Outfit();
$s = new Stellar();
$p = new Plant();

$st =  $m->evolve("up next: Dancin on theer snake and over until somebody makes me stop",0);
//echo $st," ",strlen($s),"\n";
set_error_handler(function() { print_r(debug_backtrace()); exit; });
echo $o->generate(),"\n";
echo $s->generate(),"\n";
echo $p->generate(),"\n";
