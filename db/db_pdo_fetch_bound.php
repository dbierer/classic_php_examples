<?php
// PDOStatement::bindColumn() is used to bind inbound database results, columns to variables
error_reporting(E_ERROR);

// Initialize variables
$sku = "";
$pid = "";
$unit = "";
$cost = 0;
$qty = 0;
$line = array();

// Get search string
$search = isset($_GET['Search']) ? (int) $_GET['Search'] : "";

// Create database connection
$pdo = include 'get_pdo.php';

try {

	// Proceed if the "OK" button was pressed
	if ( isset($_GET['OK'])) {

		// SQL prepare
		$sql = "SELECT * FROM products AS p WHERE p.sku = ? LIMIT 1;";
		$sth = $pdo->prepare($sql);
		$sth->bindColumn("sku", $sku);
		$sth->bindColumn("pid", $pid);
		$sth->bindColumn(3, $unit);
		$sth->bindColumn(4, $cost);
		$sth->bindColumn(5, $qty);
		$sth->execute(array($search));
		$line = $sth->fetch(PDO::FETCH_BOUND);
		
	}
	
	// Pull list of SKU numbers
	$sql = "SELECT sku FROM products;";
	$sth = $pdo->prepare($sql);
	$sth->execute();
	while ( $line = $sth->fetch(PDO::FETCH_NUM)) {		
    	// Stuff SKU into its own array
    	$sku_list[] = $line[0];
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
		<td><?php echo $sku; ?></td>
	</tr>
	<tr>
		<th>Product ID</th>
		<td><input type=text name="PID" value="<?php echo $pid; ?>" /></td>
	</tr>
	<tr>
		<th>Unit</th>
		<td><input type=text name="Unit" value="<?php echo $unit; ?>" /></td>
	</tr>
	<tr>
		<th>Cost</th>
		<td><input type=text name="Cost" value="<?php echo $cost; ?>" /></td>
	</tr>
	<tr>
		<th>Qty On Hand</th>
		<td><input type=text name="Qty" value="<?php echo $qty; ?>" /></td>
	</tr>
	<tr>
		<th>Extended Cost</th>
		<td><?php echo "$" . $qty * $cost; ?></td>
	</tr>
</table>
</form>
<br><a href="index.php">BACK</a>
<?php 
if ($message) { echo $message; } 
phpinfo(INFO_VARIABLES);
?>
</body>
</html>
