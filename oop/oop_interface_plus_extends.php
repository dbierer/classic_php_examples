<?php
interface x {
	public function get($name);
	public function set($name,$value);
}
interface y {
	function y1();
}
// will this work?
interface v extends y, x {
	public function test();
}
interface w {
}
abstract class z {
	public $z = "Z";
	function z1() {
		echo $this->z;
	}
}
class Whoa extends z implements x,y {
	function get($a) {
		echo $a;
	}
	function set($a,$b) {
		echo $a . " " . $b;
	}
	function y1() {
		echo "Y";
	}
}
$a = new Whoa();
$a->get("X");
$a->y1();
$a->z1();
?>
