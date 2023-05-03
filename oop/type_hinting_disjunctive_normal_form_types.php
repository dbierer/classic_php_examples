<?php
// shows use of union types
// NOTE: only works in PHP 8.1 and above

/**
 * Adds new value and returns new average
 *
 * @param object : ArrayObject or equivalent
 * @return float : New average
 */
function add_and_get_avg((ArrayAccess&Countable&Traversable)|array &$obj, float $value) : float
{
	// ArrayAccess allows object to act as array
	$obj[] = $value;
	$sum = 0;
	// Traversable allows object to be used in a foreach loop
	foreach ($obj as $val) $sum += $val;
	// Countable lets you use the count() function on the object
	return $sum / count($obj);
}

$obj = new ArrayObject([1,2]);
echo "Current Avg: " . add_and_get_avg($obj, 3) . "\n";	// 2
echo "Current Avg: " . add_and_get_avg($obj, 4) . "\n";	// 2.5
echo "Current Avg: " . add_and_get_avg($obj, 5) . "\n"; // 3

$arr = [1,2];
echo "Current Avg: " . add_and_get_avg($arr, 3) . "\n";	// 2
echo "Current Avg: " . add_and_get_avg($arr, 4) . "\n";	// 2.5
echo "Current Avg: " . add_and_get_avg($arr, 5) . "\n"; // 3
