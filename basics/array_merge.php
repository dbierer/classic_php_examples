<?php
$array1 = array("color" => "red", 2, 4);
$array2 = array(1 => "a","b","color" =>"green","shape"=>"trapezoid",4);
$result = array_merge($array1,$array2);
print_r($array1);
print_r($array2);
print_r($result);
?>