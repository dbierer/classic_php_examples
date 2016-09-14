<?php
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
	$sql = "SELECT `contents` FROM `serialize` WHERE `key` = ? LIMIT 1";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute(array(1));
	// Fetch
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	// Unserialize object
	$m = unserialize($result['contents']);
	var_dump($m);
} catch (PDOException $e ) {
	echo $e->getTraceAsString();
}
?>
