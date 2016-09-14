<?php
error_reporting(E_ALL | E_STRICT);

class Test1 {
	private $_test = 'TEST';
	public function test()
	{
		return $this->_test;
	}
}

class Test2 extends Test1 {
}

$a = new Test2();
echo $a->test();
echo PHP_EOL;
var_dump($a);
print_r($a);
echo $a->_test;
ReflectionObject::export($a);
$b = new Test1();
ReflectionObject::export($b);
