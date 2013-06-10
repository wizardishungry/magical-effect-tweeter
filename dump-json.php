<?php

require_once("magic.php");
require_once("outfit.php");
require_once("stellar.php");
require_once("astro.php");
require_once("plant.php");
require_once("lib.php");

$m = new Magic();
$o = new Outfit();
$s = new Stellar();
$a = new Astro();
$p = new Plant();


//set_error_handler(function() { print_r(debug_backtrace()); exit; });

echo $m->dumpJson(),"\n";
echo $o->dumpJson(),"\n";
