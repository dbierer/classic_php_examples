<?php
error_reporting(E_ALL);
class myClass1 {
	private $var = 1;
}

class myClass2 extends myClass1 {
	public function getVar()
	{
		return $this->var;
	}
}

$obj = new myClass2();
echo $obj->getVar();

?>