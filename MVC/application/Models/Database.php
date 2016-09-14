<?php
class Models_Database
{
	protected static $_adapter;
	protected static $_container;
	protected static $_driver = 'mysql';
	protected static $_user = CONTAINER;
	protected static $_host = '-db.my.phpcloud.com';
	protected static $_port = 3306;
	protected static $_dbname = CONTAINER;
	protected static $_password = 'password';

	public static function getAdapter()
	{
		if (!self::$_adapter) {
			$dsn = 	self::$_driver 
				 . ':host=' . CONTAINER . self::$_host
				 . ';dbname=' . self::$_dbname;
			self::$_adapter = new PDO($dsn, self::$_user, self::$_password);
		}
		return self::$_adapter;
	}
	
}