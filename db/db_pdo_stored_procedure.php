<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Stored Procedure Example</title>
<style>
TD {
	font: 10pt helvetica, sans-serif;
	border: thin solid black;
	text-align: right;
	}
TH {
	font: bold 10pt helvetica, sans-serif;
	border: thin solid black;
	text-align: right;
	}
</style>
</head>
<body>
<h1>Stored Procedure Example</h1>
<table>
<?php
// Create database connection
$mysql_host = "localhost";
$mysql_database = "zend";
$mysql_user = "zend";
$mysql_password = "password";
// Open connection
try {
	// Database connect
	$dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database . ";unix_socket=/var/run/mysqld/mysqld.sock";
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password);
//	$dbh->setFetchMode(PDO::FETCH_ASSOC);
	// PROCEDURE cost():
	// select a.sku,a.pid,a.cost,a.qty_oh,b.po_num,b.date,b.qty,b.price,a.cost*b.qty,b.qty*b.price from products AS a, purchases AS b WHERE a.sku = b.sku;
	$sql = "CALL cost()";
//	$sth = $dbh->query($sql);
	// Execute
	//$sth->execute();
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC
	$first = true;
//	while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	foreach ($dbh->query($sql) as $row) {
		if ($first) {
			$first = FALSE;
			echo "<tr>" .
					"<th>SKU</th>" .
					"<th>Product ID</th>" .
					"<th>PO Num</th>" .
					"<th>Purch Date</th>" .
					"<th>Qty Sold</th>" .
					"<th>Sale Price Ea</th>" .
					"<th>Gross</th>" .
					"<th>Cost</th>" .
					"<th>Net Profit</th>" .
				"</tr>\n";
		}
		$gross = $row['b.qty*b.price'];
		$cost = $row['a.cost*b.qty'];
		$net = $gross - $cost;
		echo "<tr>";
		echo "<td>" . $row['sku'] 	. "</td>";
		echo "<td>" . $row['pid'] 	. "</td>";
		echo "<td>" . $row['po_num'] . "</td>";
		echo "<td>" . $row['date'] 	. "</td>";
		echo "<td>" . $row['qty'] 	. "</td>";
		echo "<td>" . $row['price'] . "</td>";
		echo "<td>" . $gross 		. "</td>";
		echo "<td>" . $cost 		. "</td>";
		echo "<td>" . $net			. "</td>";
		echo "</tr>";
	}
} catch (PDOException $e) {
	echo "<tr><td>";
	echo $e->getMessage();
	echo "</td></tr>\n";
}

?>
</table>
</body>
</html>
