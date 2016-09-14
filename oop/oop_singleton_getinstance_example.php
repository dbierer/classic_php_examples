<?php
// singleton
class OneAndOnlyOne {

	private static $_instance;
	private static $not_first;
	
	private function __construct()
	{
	}
	
	// method returns instance of object
	public static function getInstance()
	{
		if (!isset(self::$_instance)) {
			self::$_instance = new OneAndOnlyOne();
		}
		return self::$_instance;
	}
}

$one = OneAndOnlyOne::getInstance();
var_dump($one);

$other = OneAndOnlyOne::getInstance();
var_dump($other);

$new2 = new OneAndOnlyOne();
