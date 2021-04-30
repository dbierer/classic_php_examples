<?php
// see: http://php.net/manual/en/language.oop5.traits.php
trait TestTrait
{
	protected $test = 'TEST';

	public function getTest()
	{
		return $this->test;
	}
	public function setTest($test)
	{
		$this->test = $test;
	}
	public function getSomething()
	{
		return 'TRAIT';
	}
}

class ParentClass
{
	public function getSomething()
	{
		return 'PARENT';
	}
}

class TestClass1 extends ParentClass
{
	use TestTrait;
}

class TestClass2
{
	use TestTrait;
}

echo '<pre>' . PHP_EOL;
echo phpversion();
echo PHP_EOL;

$a = new TestClass1();
echo $a->getTest() . PHP_EOL;
$a->setTest('XYZ');
echo $a->getTest() . PHP_EOL;
echo $a->getSomething() . PHP_EOL;

$b = new TestClass2();
echo $b->getTest() . PHP_EOL;
$b->setTest('ABC');
echo $b->getTest() . PHP_EOL;
echo $b->getSomething() . PHP_EOL;

echo '</pre>' . PHP_EOL;
