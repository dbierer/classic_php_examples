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

	// Proceed if the "OK" button was pressed
	if ( isset($_GET['OK'])) {

		// SQL prepare
//		$sql = "SELECT * FROM products WHERE sku = ? LIMIT 1;";
		$sql = "SELECT * FROM products WHERE sku = :skuLabel LIMIT 1;";
		$sth = $dbh->prepare($sql);
		$sth->execute(array('skuLabel' => $search));
		$result = $sth->fetch(PDO::FETCH_OBJ);
		
	}
	
	// Pull list of SKU numbers
	$sql = "SELECT sku FROM products;";
	$sth = $dbh->prepare($sql);
	$sth->execute();
	while ( $line = $sth->fetch(PDO::FETCH_NUM)) {		
    	// Stuff SKU into its own array
    	$sku_list[] = $line[0];
	}

} catch (PDOException $e) {

	$message = $e->getMessage();

} catch (Exception $e) {

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
<h1>Product Search</h1>
<!--  This is how the same script is called -->
<form name="ProductSearch" method=GET>
<h2>Miniature Replacement Bulb Inventory</h2>
<table border=1>
	<tr>
		<th>Search For:</th>
		<td>
			<select name="Search">
				<option>SKU</option>
				<?php
				// Iterate through $sku_list
				sort($sku_list);
				foreach ( $sku_list as $item ) {
					echo "<option>" . $item . "</option>\n"; 
				}
				?>
			</select>
			&nbsp;&nbsp;<input type=submit name="OK" value="OK" />
		</td>
	</tr>
	<tr>
		<th>SKU</th>
		<td><?php echo @$result->sku; ?></td>
	</tr>
	<tr>
		<th>Product ID</th>
		<td><input type=text name="PID" value="<?php echo @$result->pid; ?>" /></td>
	</tr>
	<tr>
		<th>Unit</th>
		<td><input type=text name="Unit" value="<?php echo @$result->unit; ?>" /></td>
	</tr>
	<tr>
		<th>Cost</th>
		<td><input type=text name="Cost" value="<?php echo @$result->cost; ?>" /></td>
	</tr>
	<tr>
		<th>Qty On Hand</th>
		<td><input type=text name="Qty" value="<?php echo @$result->qty_oh; ?>" /></td>
	</tr>
	<tr>
		<th>Extended Cost</th>
		<td>
		<?php echo @$result->qty_oh * $result->cost;	?>
		</td>
	</tr>
</table>
</form>
<br><a href="index.php">BACK</a>
<?php 
if ($message) { echo $message; }
var_dump($result); 
phpinfo(INFO_VARIABLES);
?>
</body>
</html>
