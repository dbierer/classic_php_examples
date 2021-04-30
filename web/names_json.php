<?php
// not used as present
$name = (isset($_GET['name'])) ? strip_tags($_GET['name']) : 'A';
$name = '%' . $name . '%';
try {
	$dsn = 'mysql:dbname=zend;host=localhost';
	$pdo = new PDO($dsn, 'test', 'password', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 
	$stmt = $pdo->query('SELECT * FROM names');
	$result = $stmt->fetchAll(PDO::FETCH_NUM);
	header('Content-Type: application/json');
	echo json_encode(['data' => $result]);
} catch (PDOException $e) {
	echo $e->getMessage();
}
