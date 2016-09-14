<?php
error_reporting(E_ALL);
date_default_timezone_set('America/Los_Angeles');
class ODate {
	const MESSAGE1 = "<br>Test......\n";
	public $message;
	public function __construct() {
		$this->message = self::MESSAGE1;
	}
	public static function DMY () {
		return date("d-m-Y", time()) . "\n";
	}
	public static function MDY () {
		return date("m/d/Y", time()) . "\n";
	}
	public static function full () {
		return date("l, F d, Y", time()) . "\n";
	}
}

// What happens here?
echo ODate::MESSAGE1;
echo ODate::DMY();
echo ODate::MDY();
echo ODate::full();

// How about when we instantiate the object?
$a = new ODate();
$a->message = 'Active Instance A' . PHP_EOL;
echo $a->message;
echo $a->DMY();
echo $a->MDY();
echo $a->full();

$b = new ODate();
$b->message = 'Active Instance B' . PHP_EOL;
echo $b->message;
echo $b->DMY();
echo $b->MDY();
echo $b->full();

?>