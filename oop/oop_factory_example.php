<?php
class Mobius {
	public $name = "Me_Myself_and_I";
	public $today = "";
	function __construct() {
		$this->today = date("Y-m-d H:i:s",time());
	}
	static function factory() {
		return new Mobius();
	}
}
$a = Mobius::factory();
var_dump($a);
?>
