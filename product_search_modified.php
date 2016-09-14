<?php
// Searches products file based on contents of "Search" field
// Turn off "Notice" error reporting
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

// Get search string
$search = "808";

// Initialize variables
$sku = "";
$pid = "";
$unit = "";
$cost = 0;
$qty = 0;
$header = array();
$line = array();

// Set up filename based on environment
$fn = "/var/www/php_exp/doug.csv";
if ($handle = fopen($fn, "r")) {

	// Read until EOF
	while (!feof($handle)) {

		// First line contains headers
		if ( !$header ) {
			
			$header = fgetcsv($handle, 4096);
			
		} else {

			// Read CSV into an array $line[]
	    	$line = fgetcsv($handle, 4096);	    	
			$key = $line[0];
			$product_info[$key] = $line;
			// DEBUG
			$result1[] = array_search($search, $line);
		}
	}

	fclose($handle);		

} else {    
	
	// Trap file read error
	$message =  "<br>Unable to open file " . $fn;

}
// DEBUG
$result2 = array_search($search, $product_info);

echo "<p>Line by Line Result: </p>";
var_dump($result1);
echo "<p>Multidimensional Result: </p>";
var_dump($result2);
echo "<p>Product Info: </p>";
var_dump($product_info); 

?>
