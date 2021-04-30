<?php
class myClass {
	private $me = NULL;
	private static $obj = NULL;
	public function __construct() {
		$this->me = "Fred";
		$this->test();
	}
	public static function getObject() {
		self::$obj = new myClass();
		return self::$obj;
	}
	function test () {
		echo "Test\n";
	}
}

$a = new myClass();
$b = $a->getObject();
$c = new myClass();
$d = myClass::getObject();
$e = myClass::getObject();
var_dump($a);
var_dump($b);
var_dump($c);
var_dump($d);
var_dump($e);
?>