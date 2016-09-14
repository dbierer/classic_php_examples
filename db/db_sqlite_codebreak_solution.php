<?php
error_reporting(E_ALL);
// Create database connection
$database = "products.sqlite";
// Open connection
try {
	// Database connect -- use one of the two statements below
	$dsn = "sqlite:" . $database;
	$dbh = new PDO(	$dsn );
	// SQL prepare
	$sql = "SELECT p.sku,r.po_num,r.qty,r.price,r.date,p.qty_oh,p.cost " .
			"FROM products AS p, purchases AS r " .
			"WHERE p.sku = r.sku;";
	$sth = $dbh->prepare($sql);
	// Execute
	$sth->execute();
	// Fetch results
	echo "<table border=1>";
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC
	$first = TRUE;
	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
		if ($first) {
			$first = FALSE;
			echo "<tr>";
			$headers = array_keys($row);
			foreach ($headers as $col) {
				echo "<th>" . $col . "</th>"; 				
			}
			echo "</tr>";
		}
		echo "<tr>";
		foreach ($row as $key => $col) {
			if ($key == "qty_oh") {
				$r = $col - $row['qty'];
				echo "<td align=right>" . $r . "</td>";				
			} elseif ($key == "cost") {
				$c = $col * $row['qty'];
				echo "<td align=right>$" . $c . "</td>";				
			} else {
				echo "<td align=right>" . $col . "</td>";			
			}		
		}
		echo "</tr>";
	}
	echo "</table>\n";
} catch (PDOException $e) {
	echo $e->getMessage();
}

?>
