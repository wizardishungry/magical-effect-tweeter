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


set_error_handler(function() { print_r(debug_backtrace()); exit; });

$st =  $m->evolve("up next: Dancin on theer snake and over until somebody makes me stop",1);
echo $st," ",strlen($st),"\n";
echo $o->generate(),"\n";
exit;
print_r($a->generate());
echo $s->generate(true),"\n";
print_r( $s->generate_a(true));
//echo $s->getImage('simpsons'),"\n";

echo $p->generate(true),"\n";
print_r($p->generate_a(true));
