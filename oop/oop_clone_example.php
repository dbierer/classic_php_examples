<?php
class Test
{
	public $array = array(1,2,3,4,5);
	public $arrayObject;
	public $b = 'B';
	public function __construct()
	{
		$this->arrayObject = new ArrayObject($this->array);
	}
}
$a = new Test();
var_dump($a);
$b = clone $a;
$b->b = 'C';
var_dump($b);
