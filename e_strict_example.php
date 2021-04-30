<?php
printf("E_ALL\t: %6d (%32b)\n", E_ALL, E_ALL);
printf("E_STRICT\t: %6d (%32b)\n", E_STRICT, E_STRICT);
printf("BOTH\t: %6d (%32b)\n", E_ALL | E_STRICT, E_ALL | E_STRICT);
error_reporting(E_ALL | E_STRICT);
// use of date() without setting timezone
$date = date('Y-m-d');
// split() deprecated
list($month, $day, $year) = split('[/.-]', $date);
echo "Month: $month; Day: $day; Year: $year<br />\n";
// PHP 4 usage
class Test
{
	var $list = array();
	function test() {
		echo 'PHP constructor' . PHP_EOL;
	}
	function __toString() {
		return 'Test';
	}
}
$a = new Test();
// undefined variable
echo $b . PHP_EOL;
// assignment in condition
if ($fh = fopen('gettysburg.txt', 'r')) {
	echo 'Successfully opened file' . PHP_EOL;
	fclose($fh);
}
?>