<?php
/**
 * 
 * Child class is used to test magic methods __get and __set
 * @author doug
 *
 */
class Child
{
	protected $_unassigned = array();
	protected static $_instance = NULL;
	
	/**
	 * 
	 * Sets properties not previous defined
	 * @param string $varName
	 * @param mixed $value
	 */
	public function __set($varName, $value)
	{
		echo 'Tried access ' . $varName . ' with this value: ' . $value;
		echo 'TEST';
	}

	/**
	 * 
	 * Retrieves undefined values
	 * @param mixed $varName
	 */
	public function __get($varName)
	{
		echo 'Tried access ' . $varName;
	}
	
	/**
	 * 
	 * Static method to return instance
	 * @return Class returns an object of type "Class"
	 */
	public static function getInstance()
	{
		if (!isset(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	protected function __construct()
	{
		
	}
}

$c = Child::getInstance();
var_dump($c);
$d = new Child();
