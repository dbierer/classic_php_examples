<?php 
class Storage {
	protected static $_storage = array();
	public static function set($name, $value) {
		self::$_storage[$name] = $value;
	}
	public static function get($name) {
		$val = NULL;
		if (isset(self::$_storage[$name])) {
			$val = self::$_storage[$name];
		}
		return $val;
	}
}

Storage::set('test', 'XYZ');
echo Storage::get('test');

?>
