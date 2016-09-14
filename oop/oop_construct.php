<?php 
class Test {
	public $name;
	public function __construct($test = 'Nothing')
	{
		$this->name = $test;
	}
}

$a = new Test();
$b = new Test('Something');
echo $a->name . PHP_EOL;
echo $b->name . PHP_EOL;
