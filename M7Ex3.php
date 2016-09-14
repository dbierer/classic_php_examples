 <?php 
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

class xParent {
	private $var = 1;
}
class Child extends xParent {
	public function test() {
		return $this->var;
	}
}
$a = new Child();
echo $a->test();
