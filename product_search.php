<?php
// Searches products file based on contents of "Search" field
// Turn off "Notice" error reporting
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// Initialize variables
$sku = "";
$pid = "";
$unit = "";
$cost = 0;
$qty = 0;
$line = array();

// Get search string
$search = isset($_GET['Search']) ? $_GET['Search'] : "";

// Set up filename based on environment
$fn = dirname($_SERVER["SCRIPT_FILENAME"]) . DIRECTORY_SEPARATOR . "doug.csv";
if ($handle = fopen($fn, "r")) {

	// Proceed if the "OK" button was pressed
	if ( isset($_GET['OK'])) {

		// Scan file until EOF
		while (!feof($handle)) {
	
	    	// Read CSV into an array $line[]
	    	$line = fgetcsv($handle, 4096);
	    	
	    	// Stop when you find matching SKU number (1st column)
	    	if ( (int) $line[0] == (int) $search ) {
	    		// Note the use of the list() language construct!
	    		list($sku, $pid, $unit, $cost, $qty) = $line;
	    		break; // break out of while loop
	    	}	
		}
	}

	// Reset file pointer
	if ( rewind($handle)) {
		
		// Scan file and extract only SKU numbers
		while (!feof($handle)) {	
	    	// Read CSV into an array $line[]
	    	$line = fgetcsv($handle, 4096);
	    	// Stuff SKU into its own array
	    	$sku_list[] = $line[0];
		}

	} else {

		// Trap file rewind error
		$message .=  "<br>Unable to re-read file " . $fn;
		
	}

	fclose($handle);		

} else {    
	
	// Trap file read error
	$message =  "<br>Unable to open file " . $fn;

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
<h2>Arcon Electrical Miniature Replacement Bulb Inventory</h2>
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