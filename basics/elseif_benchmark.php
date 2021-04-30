<?php
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}
function nospace() {
	$time_start = microtime_float();
	$max = 100000;
	$output = "";
	for ($x = 0; $x < $max; $x++) {
		if ($x % 80 == 0) {
			$output .= "<br />\n";
		} elseif ($x % 2) {
			$output .= "x";
		} else {
			$output .= "o";
		}
	} 
	$time_end = microtime_float();
	return $time_end - $time_start;
}
function space() {
	$time_start = microtime_float();
	$max = 100000;
	$output = "";
	for ($x = 0; $x < $max; $x++) {
		if ($x % 80 == 0) {
			$output .= "<br />\n";
		} else if ($x % 2) {
			$output .= "x";
		} else {
			$output .= "o";
		}
	} 
	$time_end = microtime_float();
	return $time_end - $time_start;
}
echo "<pre>";
echo "\nNO SPACE\n";
echo nospace() . "\n";
echo nospace() . "\n";
echo nospace() . "\n";
echo nospace() . "\n";
echo nospace() . "\n";
echo "\nWIITH SPACE\n";
echo space() . "\n";
echo space() . "\n";
echo space() . "\n";
echo space() . "\n";
echo space() . "\n";
echo "</pre>";

?>
