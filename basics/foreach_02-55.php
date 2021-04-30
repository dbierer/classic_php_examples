<?php
// Working Example #1 - Mod 2 Slide 55 
$arr = array(1,2,3,4);
foreach ($arr as &$value) {
	$arr[$i] = $value*2;  
}
var_dump($arr)
?>