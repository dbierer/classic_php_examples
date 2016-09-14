<?php
class Test1 {
	public $xyz = 'abc';
}

class Test2 {
	public $def;
	public function __construct()
	{
		$this->def = new Test1();
	}
}

$a = new Test2();
echo $a->def->xyz;
echo PHP_EOL;
var_dump($a);
