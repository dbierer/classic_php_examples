<?php
// Searches products file based on contents of "Search" field
error_reporting(E_ALL ^ E_NOTICE);

// Initialize variables
$line = array();

// Get search string
$search = isset($_GET['Search']) ? (int) $_GET['Search'] : "";

// Create database connection
$pdo = include 'get_pdo.php';

try {

	// Fetch an array of objects
	$products = array();
	$sql = "SELECT * FROM products;";
	$sth = $pdo->prepare($sql);
	$sth->execute();
	while ($line = $sth->fetch(PDO::FETCH_OBJ)) {		
    	// Stuff SKU into its own array
    	$products[] = $line;
	}

} catch (PDOException $e) {

	$message = $e->getMessage();

}
?>
<!DOCTYPE html>
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
