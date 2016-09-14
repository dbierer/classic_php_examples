<?php
error_reporting(E_ALL|E_STRICT);

class myClass1 {
	private $var = 1;
	function __construct() {
		echo "Here I Am!";
	}
}
class myClass2 extends myClass1 {
	public function getVar() {
		return "\n" . $this->var;
	}
}
$obj = new myClass2();
echo $obj->getVar();
var_dump($obj);
?>
