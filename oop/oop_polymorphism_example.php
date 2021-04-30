<?php
class Father
{
	public $name = 'FATHER';
	public function getName()
	{
		return $this->name;
	}
}
class Son extends Father { public $name = 'SON'; }
class GrandSon extends Son {public $name = 'GRANDSON'; }
class Xyz
{
	public function nothing()
	{
		return 'Nothing';
	}
}
class Test
{
	public function getTest(Father $f)
	{
		return $f->getName();
	}
}
$a = new Son();
$b = new Test();
$c = new Father();
$d = new GrandSon();
$x = new Xyz();
echo $b->getTest($a) . PHP_EOL; 
echo $b->getTest($c) . PHP_EOL;
echo $b->getTest($d) . PHP_EOL;
echo $b->getTest($x) . PHP_EOL;
