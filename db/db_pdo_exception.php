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
$mysql_host = "localhost";
$mysql_database = "zend";
$mysql_user = "zend";
$mysql_password = "password";
// Open connection
try {
	// Database connect -- use one of the two statements below
	// $dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database";
	$dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database . ";unix_socket=/var/run/mysqld/mysqld.sock";
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password);
	$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );	
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
	$sth = $dbh->prepare($sql);
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
