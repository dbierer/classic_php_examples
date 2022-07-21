<?php
class Test
{
	public int|float $status = 0;
}
$test = new Test();

$test->status = 22;
var_dump($test);

$test->status = 22/7;
var_dump($test);

$test->status = FALSE;
var_dump($test);

$test->status = '22';
var_dump($test);

$test->status = 'TEST';
var_dump($test);

