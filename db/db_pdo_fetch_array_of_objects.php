<?php
// Searches products file based on contents of "Search" field
error_reporting(E_ALL ^ E_NOTICE);

// Initialize variables
$line = array();

// Get search string
$search = isset($_GET['Search']) ? (int) $_GET['Search'] : "";

// Create database connection
$mysql_host = "localhost";
$mysql_database = "zend";
$mysql_user = "zend";
$mysql_password = "password";

try {

	// Database connect -- use one of the two statements below
	// $dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database;
	$dsn = 	"mysql:host=" . $mysql_host . ";dbname=" . $mysql_database . ";unix_socket=/var/run/mysqld/mysqld.sock";
	$dbh = new PDO(	$dsn, $mysql_user, $mysql_password);

	// Fetch an array of objects
	$products = array();
	$sql = "SELECT * FROM products;";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	while ($line = $sth->fetch(PDO::FETCH_OBJ)) {		
    	// Stuff SKU into its own array
    	$products[] = $line;
	}

} catch (PDOException $e) {

	$message = $e->getMessage();

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Product Search</title>
<style>
TD {
	font: 10pt helvetica, sans-serif;
	border: thin solid black;
	}
TH {
	font: bold 10pt helvetica, sans-serif;
	border: thin solid black;
	}
</style>
</head>
<body>
<h1>Return Array of Objects</h1>
<br><a href="index.php">BACK</a>
<pre>
<?php
 
var_dump($products); 
?>
</pre>
</body>
</html>
