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
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password, array());
	// SQL prepare
	$sql = "SELECT p.sku AS prodsku, p.*, u.* FROM products AS p LEFT JOIN purchases AS u ON p.sku = u.sku";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute();
	// Fetch results
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
		echo var_export($row, TRUE);
		//echo $row->pid;  // for object
		//echo $row['pid']; // for array
	}
	echo PHP_EOL;
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>
