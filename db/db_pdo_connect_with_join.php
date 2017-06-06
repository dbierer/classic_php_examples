<?php
// Create database connection
$pdo = include 'get_pdo.php';
// Open connection
try {
	// SQL prepare
	$sql = "SELECT p.sku AS prodsku, p.*, u.* FROM products AS p LEFT JOIN purchases AS u ON p.sku = u.sku";
	$sth = $pdo->prepare($sql);
	// Execute
	$sth->execute();
	// Fetch results
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
		echo var_export($row, TRUE);
		//echo $row->pid;  // for object
		//echo $row['pid']; // for array
	}
	echo PHP_EOL;
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>
