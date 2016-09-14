<?php
class Overload {
	public $list;
	public $type;
	private $a = array();
	function __construct() {
		$this->list = func_get_args();
		foreach ($this->list as $arg) {
			switch (TRUE) {
				case is_string($arg)	: $this->type[] = "String"; 	break;
				case is_int($arg) 		: $this->type[] = "Integer"; 	break;
				case is_float($arg) 	: $this->type[] = "Float"; 		break;
				case is_bool($arg) 		: $this->type[] = "Boolean"; 	break;
				case is_array($arg) 	: $this->type[] = "Array"; 		break;
				default					: $this->type[] = "Unknown";
			}
		}
	}
	function __get($x) {
		return (isset($this->a[$x]) ? $this->a[$x] : NULL);
	}
	function __set($name, $value) {
		$this->a[$name] = $value;
	}
}
$x = new Overload("Something", 22, 1.5496, FALSE);
$x->notThere = "Will This Work?";
echo $x->notThere . "\n";
var_dump($x);
?>
