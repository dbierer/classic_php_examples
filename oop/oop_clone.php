<?php
class Num {
	public $number;
	public $obj;
	public $array = array(1,2,3,4,5);
	function __construct($num = NULL) {
		if ($num == NULL) {
			$this->number = 10;
		} else {
			$this->number = $num;
		}
	}
	function __clone() {
		$this->number = 999;
	}
}

$a = new Num(888);
$b = $a;
$c = clone $a;

// Compare $a and clone 
echo ($a == $c) ? "== SAME\n" : "== NOT SAME\n";
echo ($a === $c) ? "=== SAME\n" : "=== NOT SAME\n";

$b->number = -1;
$d = clone $b;
$d->obj = new Num();
$e = new Num();

// Dumps
echo "Dump New Instance A\n";
var_dump($a);
echo "Dump Reference B\n";
var_dump($b);
echo "Dump Clone C\n";
var_dump($c);
echo "Dump Clone of Reference D\n";
var_dump($d);
echo "Dump New Instance E\n";
var_dump($e);
?>