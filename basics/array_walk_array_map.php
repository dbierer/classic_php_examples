<?php
// array_walk works when you define a function with the incoming array value as a reference
function convert(&$value) {
	$value = strtoupper($value);
}
$a = explode(' ', 'The quick brown fox jumped over the fence.');
array_walk($a, 'convert');
var_dump($a);
// array_map does the same as above but is easier to implement
$a = explode(' ', 'The quick brown fox jumped over the fence.');
$a = array_map('strtoupper', $a);
var_dump($a);
?>
