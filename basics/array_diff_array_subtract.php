<?php
$a = array(1, 2, 3, 4, 5);
$b = array(2, 4, 6);
var_dump(array_diff($a, $b));
echo PHP_EOL;
$c = $a - $b;
var_dump($c);
