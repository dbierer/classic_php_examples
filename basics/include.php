<?php
// note: any procedural code will execute immediately
echo 'Executable code originating from ' . __FILE__ . '<br/>' . PHP_EOL;
define('SOME_VALUE', rand(0, 999));
function timesTwo($result = NULL)
{
	$result *= 2;
	return $result;
}
class Test {
	public $test = 'TEST';
	public function whatever()
	{
		return 'XYZ';
	}
}
echo '<h1>' . $value . '</h1>';
?>
	