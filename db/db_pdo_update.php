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
    // set up SQL using PDO::quote()
    $sql = sprintf(
        'UPDATE orders SET description=%s WHERE id=%s', 
        $pdo->quote('New Description'), // new description
        $pdo->quote('1'));              // ID to update
    // run the command directly
    $affected = $pdo->exec($sql);
    $message = 'Success! ' . $affected . ' row(s) updated';
} catch (PDOException $e) {
    error_log(date('Y-m-d H:i:s') . ':' . $e->getMessage());
} finally {
    echo $sql . PHP_EOL . $message;
}
echo PHP_EOL . '</pre>';
