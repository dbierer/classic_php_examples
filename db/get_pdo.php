<?php
// Create database connection
$user = "test";
$password = "password";
$host = "localhost";
$database = "zend";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
// Open connection
try {
    // Database connect -- use one of the two statements below
    $dsn =  'mysql:host=' . $host . ';dbname=' . $database;
	// $dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database . ";unix_socket=/var/run/mysqld/mysqld.sock";
    // The above works better if database is on same server and a socket is available:
    $pdo = new PDO( $dsn, $user, $password, $options);
} catch (PDOException $e) {
    die($e->getMessage());
}
return $pdo;
