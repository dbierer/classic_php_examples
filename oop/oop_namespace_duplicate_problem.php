<?php
namespace X {
	class Test {
		public function whatever()
		{
			return 'X';
		}
	}
}

namespace Y {
	class Test {
		public function whatever()
		{
			return 'Y';
		}
	}
}

namespace {
	use X\Test as XT;
	use Y\Test as YT;
//	use X\Test;
//	use Y\Test;
	//use Y\Test;
//	$a = new Test();
	$a = new XT();
	echo $a->whatever();
	$b = new \Y\Test();
	echo $b->whatever();
}