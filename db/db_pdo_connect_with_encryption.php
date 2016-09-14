<?php
// Configure encryption
//set_include_path(__DIR__ . DIRECTORY_SEPARATOR . 'PEAR' . PATH_SEPARATOR . get_include_path());
include "PEAR/Crypt/Blowfish.php";
function decrypt($contents, $key, $iv) {
	$bf =& Crypt_Blowfish::factory('cbc');
	$bf->setKey($key, $iv);
	return $bf->decrypt($contents);
}

/* Read contents of encrypted password file  */
$contents = explode('&&', file_get_contents('user.txt'));

/* Encrypt & Decrypt */
$iv = "abc123+=";
$key = "Some Secret Key";

// Create database connection
$host 		= "localhost";
$database 	= "zend";
$user 		= decrypt($contents[0], $key, $iv);
$password 	= decrypt($contents[1], $key, $iv);
// Open connection
try {
	// Database connect -- use one of the two statements below
	// $dsn = 	"mysql:host=" . $host . ";dbname=" . $database";
	$dsn = 	"mysql:host=" . $host . ";dbname=" . $database . ";unix_socket=/var/run/mysqld/mysqld.sock";
	$dbh = new PDO(	$dsn, $user, $password);
	// SQL prepare
	$sql = "SELECT * FROM products";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute();
	// Fetch results
	echo "<table border=1>";
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
	while ($row = $sth->fetch(PDO::FETCH_NUM)) {
		echo "<tr><td>";
		echo implode('</td><td>', $row);
		echo "</td></tr>\n";
	}
	echo "</table>\n";
} catch (PDOException $e) {
	echo $e->getMessage();
}

// code to create encrypted password file
/*
function encrypt($contents, $key, $iv) {
	$bf =& Crypt_Blowfish::factory('cbc');
	$bf->setKey($key, $iv);
	return $bf->encrypt($contents);
}

 */
//$user 		= encrypt('username', $key, $iv);
//$password 	= encrypt('password', $key, $iv);
//file_put_contents('user.txt', $user . '&&' . $password);

?>
