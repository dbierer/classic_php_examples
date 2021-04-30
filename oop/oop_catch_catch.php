<?php
//error_reporting(-1);
// Create database connection
$mysql_host = "localhost";
$mysql_database = "zend";
$mysql_user = "zend";
$mysql_password = "password";
// Open connection
try {
	// Database connect -- use one of the two statements below
	// $dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database";
	$dsn = 	"mysql:host=$mysql_host;dbname=$mysql_database;unix_socket=/var/run/mysqld/mysqld.sock";
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password);
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );	
	// SQL prepare
	$sql = "SELECT * FROM a-table-which-does-not-exist";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute();
	// Fetch results
	echo "<table border=1>";
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC
	while ($row = $sth->fetch(PDO::FETCH_NUM)) {
	echo "<tr>";
		foreach ($row as $col) {
			echo "<td>" . $col . "</td>"; 				
		}
		echo "</tr>";
	}
	echo "</table>\n";
} catch (PDOException $e) {
	echo $e->getMessage();
	echo PHP_EOL;
	echo $e->getTraceAsString();
}
