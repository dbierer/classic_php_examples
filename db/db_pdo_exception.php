<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PDO Exception</title>
</head>
<body>
<form method=GET>
<b>Problem:</b>
<br /><input type=radio name="problem" value="1" />&nbsp;Y
<br /><input type=radio name="problem" value="0" />&nbsp;N
<br /><input type=submit />
</form>
<?php
//error_reporting(-1);
// Create database connection
$pdo = include 'get_pdo.php';
// Open connection
try {
	// SQL prepare
	if (isset($_GET['problem'])) {
		$problem = ($_GET['problem']) ? 1 : 0;
	} else {
		$problem = 0;
	}
	if ($problem) {
		$sql = "SELECT * FROM a-table-which-does-not-exist";
	} else {
		$sql = "SELECT * FROM products";
	}
	$sth = $pdo->prepare($sql);
	// Execute
	$sth->execute();
	// Fetch results
	echo "<table border=1>";
	// Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC
	while ($row = $sth->fetch(PDO::FETCH_NUM)) {
	echo "<tr>";
		foreach ($row as $col) {
			echo "<td>" . $col . "</td>"; 				
		}
		echo "</tr>";
	}
	echo "</table>\n";
} catch (PDOException $e) {
	echo "<br />PDOException<br />\n";
	echo $e->getMessage();
} catch (Exception $e) {
	echo "<br />Exception<br />\n";
	echo $e->getMessage();
}
?>
<br /><a href="index.php">BACK</a>
</body>
</html>
