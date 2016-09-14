<?php
// needs to go into ./A/X/Test.php
namespace A\X;

class Test {
	protected $name = 'X-Test';
	public function setName($name = 'Default')
	{
		$this->name = $name;
	}
	public function getName()
	{
		return $this->name;
	}
}
