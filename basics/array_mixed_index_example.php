<?php 
//$myArray = array('2' =>1, '3' => 3, 'b' =>4, 4 => 2);
$myArray['2'] = 1;
$myArray['3'] = 3;
$myArray['b'] = 4;
$myArray['4'] = 2;
$myArray[] = 5;
$myArray['0'] = 0;
$myArray[] = 6;

var_dump($myArray);
?>