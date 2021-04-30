<?php
// Provides object-oriented access to $_SESSION
// is configured as a "singleton" allowing only 1 instance
// NOTE: only works in PHP 7 and above
class SessionObject 
{

    const SESSION_KEY = __CLASS__;
	private static $_instance;
	private $values;
	
    // making __construct() private prevents outside instances being created
	private function __construct() {}
	
	// method returns instance of object
	public static function getInstance()
	{
		if (!isset(self::$_instance)) {
            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }
			self::$_instance = new self();
		}
		return self::$_instance;
	}
    
    // stores values in session
    public function __set($name, $value)
    {
        $_SESSION[self::SESSION_KEY][$name] = $value;
        return TRUE;
    }
    // gets values from session
    public function __get($name)
    {
        return $_SESSION[self::SESSION_KEY][$name] ?? NULL;
    }
    // wipes out all values (i.e. during logout)
    public function clear()
    {
        if (isset($_SESSION[self::SESSION_KEY])) {
            unset($_SESSION[self::SESSION_KEY]);
        }
    }
}

// usage example:
$sessObj = SessionObject::getInstance();

// set a value
$sessObj->date = date('l, d M Y');

// get the value
echo 'Date Before Clear: ' . $sessObj->date . PHP_EOL;

// clear values
$sessObj->clear();

// get the value
echo 'Date After Clear: ' . $sessObj->date . PHP_EOL;

// try to create instance
try {
    $newSess = new SessionObject();
    $newSess->date = date('l, d M Y');
    echo $newSess->date;
} catch (Error $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
}

