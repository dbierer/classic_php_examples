<?php
// Shows type hinting
class Product {
	public $sku;
	public $pid;
	public $unit;
	public $cost;
	public $qty;
	
	function __construct($a,$b,$c,$d,$e) {
		$this->sku = $a;
		$this->pid = $b;
		$this->unit = $c;
		$this->cost = $d;
		$this->qty = $e;
	}
}

function calc (Product $p) {
	echo $p->cost * $p->qty;
}

$item = "11971";
$product = new Product($item,"71","CD/2",35.05,993);
calc($item);

?>