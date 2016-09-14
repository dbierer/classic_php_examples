<?php
$add = function ($a, $b) {
	return $a + $b;
};

$sub = function ($a, $b) {
	return $a - $b;
};

$xyz = '';

function test(callable $func, $a, $b)
{
	return $func($a, $b);
}

echo test($add, 6, 3);
echo PHP_EOL;
echo test($sub, 6, 3);
echo PHP_EOL;
echo test($xyz, 6, 3);