<?php 
// M2Ex2 -- arrays
$var = array(2 => 1, 3 => 3, 'b' => 4, 4 => 2);
var_dump($var);
$var[4] = 'TEST';
$var[]  = '123';
var_dump($var);
sort($var, SORT_STRING);
var_dump($var);

?>
