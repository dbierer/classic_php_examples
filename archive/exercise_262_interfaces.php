<?php
interface myInterface {
	function test();
}
class myClass extends myInterface {
	public function test() {
		echo "Test";
	}
}
function myFunction(myInterface $obj) {
	$obj->test();
}
$obj = new myClass();
myFunction($obj);
?>