<?php 
$a = '8X';
var_dump($a);
$a = $a + 3;
var_dump($a);
$b = "10";
$c = "-20 30 something";
$d = "Total = " . ($b + $c);
var_dump($d);
$d = $b + $c;
var_dump($d);
$d = "Total = " + ($b . $c);
var_dump($d);
$e = (float) '8.8';
var_dump($e);
$e = (int) '8.8';
var_dump($e);
$f = (int) 8.8;
var_dump($f);
$g = (object) $f;
var_dump($g);

?>