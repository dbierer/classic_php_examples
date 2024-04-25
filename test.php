<?php
interface TestInterface
{
	public function test();
}

abstract class Super implements TestInterface
{
	public function test()
	{
		return 'TEST';
	}
	public function getTest()
	{
		return $this->test();
	}
}

class Child extends Super implements TestInterface
{}

$child = new Child();
