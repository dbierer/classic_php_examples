<?php 
$a = 1;
// pre-increment
echo ++$a;
echo PHP_EOL;
var_dump($a);
$b = 1;
// post-increment
echo $b++;
echo PHP_EOL;
var_dump($b);
echo PHP_EOL;
// both operands int; evenly divisible
$c = 8 / 2;
var_dump($c);
echo PHP_EOL;
// both operands int; not evenly divisible
$d = 8 / 3;
var_dump($d);
echo PHP_EOL;
// evenly divisible but both operands not int
$e = 8 / 2.0;
var_dump($e);
echo PHP_EOL;

?>