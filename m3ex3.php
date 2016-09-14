<?php
// Function makeArrayUpper() goes here
// Accepts an array by reference
// Converts array contents to uppercase
// Returns true if input = type Array; false otherwise

// Test data
$array1 = explode(' ', 'Zend Training - Building Security into your PHP Applications');
$array2 = 'This is not an array';

if (makeArrayUpper($array1)) {
	echo "\n SUCCESS \n";
	var_dump($array1);
} else {
	echo "\n NOT AN ARRAY \n";
}

if (makeArrayUpper($array2)) {
	echo "\n SUCCESS \n";
	var_dump($array1);
} else {
	echo "\n NOT AN ARRAY \n";
}

?>