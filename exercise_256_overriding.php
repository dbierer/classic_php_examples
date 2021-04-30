<?php

class myClass1 {
	
	public function test() {
		return 1;
	}
	
	public function test2() {
		return $this->test();
	}
}

class myClass2 extends myClass1  {
	
	protected function test()
	{
		return 2;
	}
}

$obj = new myClass2();
echo $obj->test2();

// Fatal error because child cannot lower the visibility of a parent method
// Visibility (scope) is covered in slide 266
?>
