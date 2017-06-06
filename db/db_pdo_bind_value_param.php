<?php
// PDOStatement::bindValue() and PDOStatement::bindParam() are used for outbound SQL queries in prepared statements
function results($sth) {
	while ($row = $sth->fetch(PDO::FETCH_OBJ)) {
		echo "$row->sku : $row->cost : $row->qty_oh\n";
	}
}

// Initialize vars
$cost = 50.00;
$qty  = 100;
// Create database connection
$pdo = include 'get_pdo.php';
// Open connection
try {
	// SQL prepare
	$sql = "SELECT * FROM products WHERE cost > :cost AND qty_oh < :qty";
	$sth1 = $pdo->prepare($sql);
	// Bind Param passes by ref = can only bind variables
	$sth1->bindParam(':cost', $cost);
	$sth1->bindParam(':qty', $qty, PDO::PARAM_INT);
	var_dump($sth1);
	// Execute
	$sth1->execute();
	// Fetch results
	results($sth1);
	// Bind Value lets you pass values or variables
	$sth2 = $pdo->prepare($sql);
	$sth2->bindValue(':cost', 50);
	$sth2->bindValue(':qty', $qty, PDO::PARAM_INT);
	var_dump($sth2);
	// Execute
	$sth2->execute();
	// Fetch results
	results($sth2);
} catch (PDOException $e) {
	echo $e->getMessage();
}
?>
