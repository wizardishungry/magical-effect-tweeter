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

print_r($a->generate());
$st =  $m->evolve("up next: Dancin on theer snake and over until somebody makes me stop",10000);
echo $st," ",strlen($st),"\n";
set_error_handler(function() { print_r(debug_backtrace()); exit; });
echo $o->generate(),"\n";
echo $s->generate(true),"\n";
//echo $s->getImage('simpsons'),"\n";

echo $p->generate(true),"\n";
print_r($p->generate_a(true));
