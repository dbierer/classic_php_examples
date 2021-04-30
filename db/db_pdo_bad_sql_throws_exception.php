<?php
ini_set('display_errors', 1);
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
	$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    //$dbh = new PDO(	$dsn, $mysql_user, $mysql_password);
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password, $options);
	// Set error mode (see http://www.php.net/manual/en/pdo.error-handling.php)
	// alternatively:
	//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// SQL prepare
	$sql = "THIS IS NOT SQL";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute();
	// Fetch results
	echo "<table border=1>";
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
	while ($row = $sth->fetch(PDO::FETCH_LAZY)) {
		$val = var_export($row, TRUE); 
		echo "<tr><td>$val</td></tr>\n"; 
	}
	echo "</table>\n";
} catch (PDOException $e) {
	echo 'PDO Exception Class' . PHP_EOL;
	echo $e->getMessage();
} catch (Exception $e) {
	echo 'Exception Class' . PHP_EOL;
	echo $e->getMessage();
}

?>
