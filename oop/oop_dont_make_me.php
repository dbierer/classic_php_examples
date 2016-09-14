<?php
class dont_make_me {
	
	public static $store = array();
	
	public function __construct()
	{
		throw new Exception('I Told You So!');
	}
	
	public static function set($name, $value)
	{
		self::$store[$name] = $value;
	}
	
	public static function get($name)
	{
		return (isset(self::$store[$name])) ? self::$store[$name] : NULL;
	}
}
dont_make_me::set('test','TEST');
echo dont_make_me::get('test');
// $a = new dont_make_me();
?>
