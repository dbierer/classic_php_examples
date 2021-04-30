<?php
function test1 ( $a = 30 ) {
	global $f;
	$f = 99;
	$b = 40;
	echo "\nTest 1\n";
	echo "\n" . $a + $b . "\n";
}
function test2 () {
	$a = 60;
	$b = 40;
	echo "\nTest 2\n";
	echo "\n" . $a + $b . "\n";
}
function test3 () {
	global $a;
	global $b;
	echo "\nTest 3\n";
	echo "\n" . $a + $b . "\n";
}
function test4 () {
	echo "\nTest 4\n";
	echo "\n" . $GLOBALS['a'] + $GLOBALS['b'] . "\n";
}

$a = 10;
$b = 20;
$GLOBALS['c'] = 30;
echo "\n$c\n";
test1();
echo "\nf: $f\n";
var_dump($GLOBALS);
//test1(50);
//test2();
//test3();
//$GLOBALS['a'] = 100;
//$GLOBALS['b'] = 200;
//test4();
//echo "\n";
//echo "\nMain Test\n";
//echo "\n" . $a + $b . "\n";
?>