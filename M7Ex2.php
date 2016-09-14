<?php
// storage class class_name {
class Storage {
	protected static $_whatever = array();
	public static function setProperty($name, $value) {
		self::$_whatever[$name] = $value;
		return TRUE;
	}
	public static function getProperty($name) {
		return self::$_whatever[$name];
	}
}

Storage::setProperty('abc', 'xyz');
/*
 * Some Code
 * ...
 * etc.
 */
echo Storage::getProperty('abc');
