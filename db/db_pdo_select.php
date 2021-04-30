<?php
$output = '';
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
	$sql = "SELECT * FROM products AS p";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute();
	// Fetch results
	$output .= "<table border=1>\n";
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
		$val = var_export($row, TRUE); 
		$output .= "<tr><td>$val</td></tr>\n";
	}
	$output .= "</table>\n";
} catch (PDOException $e) {
	$output .= $e->getMessage();
}
echo $output;

