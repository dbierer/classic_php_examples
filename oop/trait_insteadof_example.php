<?php
// this instead of that
// see: http://php.net/manual/en/language.oop5.traits.php
trait TestTrait1
{
	public function someTest()
	{
		return '1111111';
	}
}
trait TestTrait2
{
	public function someTest()
	{
		return '2222222';
	}
}

class TestClass
{
	// causes Fatal Error
	//use TestTrait1, TestTrait2;
	use TestTrait1, TestTrait2 { TestTrait1::someTest insteadof TestTrait2; }
}

$a = new TestClass();
echo $a->someTest();

