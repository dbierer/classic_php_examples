<?php
class myClass {
	private $var = 1;
	function get() {
		return $this->var;
	}
}
class myClass2 extends myClass {
	public function test() {
		return $this->var;
	}
}
$c1 = new myClass();
$c2 = new myClass2();
echo $c2->test();
//echo $c1->$var;
//echo $c2->$var;
//echo $c2->get();
?>