<?php
$a = array("First" => "Doug", "Last" => "Bierer");
var_dump($a);
echo "\nLine 4:" . $a[0] . " " . $a[1];
$a = array("Doug", "Bierer");
echo "\nLine 5:" . $a[0] . " " . $a[1] . "\n";
$a = array("First" => "Doug", "Bierer");
var_dump($a);
echo "\nLine 7:" . $a[0] . " " . $a[1];
$a = array("1" => "Doug", "Bierer");
var_dump($a);
$a = array(2 => "Doug", "Bierer");
var_dump($a);
?>
