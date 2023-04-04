<?php
// data type the return value
// NOTE: this only works if you're running PHP 8.2+

declare(strict_types=1);
class Absolutes
{
	public function go_fail($val = FALSE) : false
	{
		// do something
		return $val;
	}
	public function go_succeed($val = TRUE) : true
	{
		// do something
		return $val;
	}
	public function go_null($val = NULL) : null
	{
		// do something
		return $val;
	}
}

$func = function ($abs, $method, $val = NULL) {
	try {
		$result = var_export($abs->$method($val), TRUE);
	} catch (Throwable $t) {
		$result = $t->getMessage();
	}
	return $result . PHP_EOL;
};

$abs = new Absolutes();
echo $func($abs, 'go_fail', FALSE);		// false
echo $func($abs, 'go_succeed', TRUE);	// true
echo $func($abs, 'go_null', NULL);		// NULL
echo $func($abs, 'go_fail', 1);		// Return value must be of type false, int returned
echo $func($abs, 'go_succeed', 1);	// Return value must be of type true, int returned
echo $func($abs, 'go_null', 1);		// Return value must be of type null, int returned

// actual output:
/*
false
true
NULL
Absolutes::go_fail(): Return value must be of type false, int returned
Absolutes::go_succeed(): Return value must be of type true, int returned
Absolutes::go_null(): Return value must be of type null, int returned
*/



