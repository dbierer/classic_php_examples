<?php
function pdoFactory($dsn, $username, $password)
{
	try {
		$pdo = new PDO($dsn, $username, $password);
	} catch (PDOException $e) {
		error_log($e->getMessage());
		return FALSE;
	}
	return $pdo;
}

$zendPdo = pdoFactory('mysql:dbname=zend;host=localhost', 'test', 'password');
$testPdo = pdoFactory('mysql:dbname=test;host=127.0.0.1', 'test', 'password');

