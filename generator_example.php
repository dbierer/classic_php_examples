<?php
// uses generator to produce an array of characters from a string
// yield = multiple x return; like a return buffer
// NOTE: requires PHP 5.5!!!
function stringCharsToArray($string)
{
	for ($x = 0; $x < strlen($string), $x++) {
		yield substr($string, $x, 1);
	}
}

var_dump(stringCharsToArray('abcdef'));