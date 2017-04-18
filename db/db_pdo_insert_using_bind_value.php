<?php
// init vars
$output = '';
$sql = '';
$message = 'ERROR! No row(s) were updated';
// database params
$mysql_user = 'test';
$mysql_password = 'password';
$mysql_host = 'localhost';
$mysql_database = 'zend';
$mysql_socket = '/var/run/mysqld/mysqld.sock';
// Open connection
echo '<pre>' . PHP_EOL;
try {
	// Database connect -- use one of the two statements below
    // Use this if the database is on another server or sockets are not available:
	// $dsn = 	'mysql:host=' . $mysql_host . ';dbname=' . $mysql_database';
    // Otherwise use this if running on the same server:
	$dsn = 	'mysql:host=' . $mysql_host . ';dbname=' . $mysql_database . ';unix_socket=' . $mysql_socket;
    // create database connection
	$pdo = new PDO(	$dsn, $mysql_user, $mysql_password);
    $sql = 'INSERT INTO customers (firstname,lastname) VALUES (:fname,:lname)';
    $stmt = $pdo->prepare($sql);
    // Hard coded value bindings
    $stmt->bindValue(':fname', 'Mark');
    $stmt->bindValue(':lname', 'Whitney');
    // Execute the SQL statement
    if ($stmt->execute()) {
        $message = 'SUCCESS: last ID: ' . $pdo->lastInsertId();
    }
} catch (PDOException $e) {
    error_log(date('Y-m-d H:i:s') . ':' . $e->getMessage());
} finally {
    echo $sql . PHP_EOL . $message;
}
echo PHP_EOL . '</pre>';
// OUTPUT:
// INSERT INTO orders (date, status, amount, description, customer) VALUES ('1492507110','active','200','cool backpack','4')
// SUCCESS: 9:1492507110:active:200:cool backpack:4
