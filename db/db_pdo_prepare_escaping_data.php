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
	// Set error mode (see http://www.php.net/manual/en/pdo.error-handling.php)
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// SQL prepare
	$sql = "SELECT * FROM names WHERE address LIKE ?";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute(array('%rabbit estates%'));
	var_dump($sth);
	// Fetch results
	echo "<table border=1>";
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
	while ($row = $sth->fetch(PDO::FETCH_LAZY)) {
		$val = var_export($row, TRUE); 
		echo "<tr><td>$val</td></tr>\n"; 
	}
	echo "</table>\n";
} catch (PDOException $e) {
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage();
}

?>
