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
    $message = 'ERROR: insert did not succeed';
    $data = [time(),'active','200','cool backpack','4'];
    array_walk($data, function (&$val) use ($pdo) { $val = $pdo->quote($val); });
    $sql  = 'INSERT INTO orders '
          . '(date, status, amount, description, customer) '
          . 'VALUES (' . implode(',', $data) . ')';
    $stmt = $pdo->query($sql);
    // Get last insert ID
    $id = $pdo->lastInsertId();
    // Retrieve the update
    if ($id) {
        $stmt = $pdo->query( 'SELECT * FROM orders WHERE id = ' . $id );
        // Get the new entry
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Output the result
        $message = 'SUCCESS: ' . implode(':', $result);
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
