<?php
interface I {
	public function test();
}
interface K {
    // will this cause a problem?
	public function test(array $x);
	//public function test();
	public function xyz();
	public function abc();
}
class MyClass1 implements I {
	public function test() {
		return 1;
	}
}
class MyClass2 implements I, K {
	public function test() {
		return 2;
	}
	public function xyz() {
		return 'xyz';
	}
	public function abc()
	{
		return 'abc';
	}
}
class MyClass3 extends MyClass1 implements K
{
	// test() is defined in MyClass1 -- is inherited 
	public function xyz() {
		return 'xyz';
	}
	public function abc()
	{
		return 'abc';
	}
}

function xyz(I $value) {
	return $value->test();
}

$a = new myClass1();
$b = new myClass2();

echo xyz($a) . PHP_EOL;
echo xyz($b) . PHP_EOL;

?>
