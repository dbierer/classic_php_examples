<?php
class myClass {
	public $a = array(1,2,3,"name" => "doug");
	public $label = "ABC";
	public $date;
	function __construct() {
		$this->date = date("Y-m-d H:i:s",time());
	}
	function __sleep() {
		echo "Sleeping\n";
		var_dump($this);
		return array('a','label','date');
//		return array('label'); 	// what's in the return is what is placed into string
	}
	function __wakeup() {
		echo "Wakeup\n";
	}
}
$m = new myClass;
$s = serialize($m);
echo $s;
// Create database connection
$mysql_host = "localhost";
$mysql_database = "zend";
$mysql_user = "zend";
$mysql_password = "password";
// Open connection
try {
	// Database connect -- use one of the two statements below
	// $dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database";
	$dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database . ";unix_socket=/var/run/mysqld/mysqld.sock";
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password);
	// SQL prepare
	$sql = "UPDATE `serialize` SET `contents` = ? WHERE `key` = ?";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute(array($s,1));
} catch (PDOException $e ) {
	echo $e->getTraceAsString();
}
var_dump($GLOBALS);
?>
