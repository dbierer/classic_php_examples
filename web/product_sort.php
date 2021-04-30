<?php
// Sorts products file by column whose button has been pressed
// Turn off "Notice" error reporting
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// Initialize variables
$product_info = array();		// what this is
$line = "";
$x = 0;
$header = array();
$key = 0;

// Trap incoming $_REQUEST info
$sort_key = $_POST['sort'];
if ( !isset( $sort_key )) {
	$sort_key = "SKU";
}

// Here's the code to read the file line by line
$fn = dirname($_SERVER["SCRIPT_FILENAME"]) . "/" . "doug.csv";
if ($handle = fopen($fn, "r")) {
    while (!feof($handle)) {

    	// Read line into buffer -- in CSV format
    	$line = fgetcsv($handle, 4096);
		
		// Check to see if $header is empty
		if ( empty($header)) {
			// Store in $header
			$header = $line;
			// Figure out which element = $sort_key
			$index =  array_search($sort_key,$header);
		} else {
			// Store into $product_info, with sort column as first item + 
			// SKU number to make sure it's unique
			$key = $line[$index] . "-" . $line[0];
			// Assign an array $line[] to $key in $product_info array
			$product_info[$key] = $line;
		}
	}
    fclose($handle);

	// Sort using "natural" algorithmn
	$keys = array_keys($product_info);
    natsort($keys);

} else {    

	// Trap file read error
	$message =  "<br>Unable to open file " . $fn;

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Product Sort</title>
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
<h1>Product Sort</h1>
<!--  This is how the same script is called -->
<form name="ProductSort" action="product_sort.php" method=POST>
<h2>Arcon Electrical Miniature Replacement Bulb Inventory</h2>
<br><a href="index.php">BACK</a>
<table border=1>
<?php
// Initialize total
$total = 0;	

// Print header row
if ( empty($header)) {
	print "<tr><th colspan=5>Error Opening Inventory File!</th></tr>\n";
} else {
	print "<tr>";
	$width = 0;
	foreach ( $header as $item ) {
		print '<th><input type=submit name="sort" value="' . $item . '"></th>';
		$width++;
	}
	$width += 2;	// compensate for 2 added columns in data set
	print "</tr>\n";
	
	// Iterate through product array
	foreach ( $keys as $item ) {
		print "<tr>";
		// Start at 2 because 1st 2 columns are used only for sorting purposes
		foreach ( $product_info[$item] as $a ) {
			print "<td align=right>$a</td>";
		}
		print "</tr>\n";
		$total += $product_info[$item][3] * $product_info[$item][4];
	}
}
?>
<tr><th colspan=2>TOTAL INVENTORY</th><td colspan=3 align=right><?php echo sprintf ( "%01.2f", $total ); ?>
</table>
</form>
<?php if ($message) { echo $message; } ?>
</body>
</html>