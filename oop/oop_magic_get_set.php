 <?php 
class xParent {
	private $var = 1;
}
class Child extends xParent {
	protected $_values = array();
	public $test = '';
	public function test() {
		return $this->var;
	}
	public function __set($name, $value)
	{
		echo 'SET';
		echo PHP_EOL;
		$this->_values[$name] = $value;
	}
	public function __get($name)
	{
		echo 'GET';
		echo PHP_EOL;
		return (isset($this->_values[$name])) ? $this->_values[$name] : NULL;
	}
}
$a = new Child();
echo $a->test();
echo PHP_EOL;
$a->abc = "xyz";
echo $a->abc;
echo PHP_EOL;
$a->test = 'TEST';
echo $a->test;
 ?>