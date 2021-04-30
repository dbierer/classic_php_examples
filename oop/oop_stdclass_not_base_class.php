<?php
// Is class Test a subclass of stdClass()?
class Test {
	public $name = 'TEST';
}
$a = new Test();
echo (is_subclass_of($a, stdClass)) ? 'TRUE' : 'FALSE';
echo PHP_EOL;
ReflectionObject::export($a);
$b = new stdClass();
ReflectionObject::export($b);
