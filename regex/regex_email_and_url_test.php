<?php
error_reporting(E_ALL^E_WARNING);
// Complete the pattern for a jpg file
$test = array("test.jpeg","test.jpg",".jpg");
$pattern = '/^[\w|-]+\.(jpg|jpeg)$/';
//$pattern = '/.+\.[jpg|jpeg]$/';
foreach ($test as $input) {
	echo "\n$input\n";
	echo preg_match($pattern,$input) ? "MATCH" : "NO MATCH";
	echo "\n";
}
// Test for URL
$test = array("www.unlikelysource.com","ibm.co.uk","this is a.badurl",".com");
$pattern = '/^([\w|-]+\.){2,3}(\w{2,4})$/';
foreach ($test as $input) {
	echo "\n$input\n";
	echo preg_match($pattern,$input) ? "MATCH" : "NO MATCH";
	echo "\n";
}
?>
