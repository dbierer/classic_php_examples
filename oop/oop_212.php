<?php
class test1 {
	public function f2() {
		echo 'Parent';
	}
}
class test2 extends test1 {
	public function f1() {
		echo $this->f2();
		echo parent::f2();
	}
	protected function f2() {
		echo 'Child';
	}
}
$test = new test2();
$test->f1();
?>
