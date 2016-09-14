<?php
class Test
{
	protected $_name = 'DEFAULT';
	
	public function __construct($name = '')
	{
		if ($name) {
			$this->_name = $name;
		}
	}

	public function getName()
	{
		return $this->_name;
	}
	
}

$test1 = new Test('DOUG');
echo $test1->getName() . PHP_EOL;
$test2 = new Test();
echo $test2->getName() . PHP_EOL;
echo $test2->_name . PHP_EOL;
