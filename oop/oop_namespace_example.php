<?php
namespace X {
	class Abc {
		public $abc = 'X';
		public function getAbc() 
		{
			return $this->abc;
		}
	}
}

namespace Y {
	class Abc {
		public $abc = 'Y';
		public function getAbc() 
		{
			return $this->abc;
		}
	}
}

namespace Z {
	class Abc {
		public $abc = 'Z';
		public function getAbc()
		{
			return $this->abc;
		}
	}
}

// Global namespace
namespace {
	
	use X\Abc;
//	use Y\Abc;
	use Y\Abc as YAbc;
	// NOTE: "use" allows relative reference to the namespace
	$x = new Abc();
	echo $x->getAbc() . PHP_EOL;
	$y = new YAbc();
	echo $y->getAbc() . PHP_EOL;
	
	// otherwise we need absolute reference to the namespace
	// the leading "\" is optional
	$z1 = new \Z\Abc();
	echo $z1->getAbc() . PHP_EOL;
	$z2 = new Z\Abc();
	echo $z2->getAbc() . PHP_EOL;
	
}