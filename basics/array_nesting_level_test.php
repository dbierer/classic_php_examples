<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// shows how deeply PHP allows array nesting
$count = 1;
function addArrayToElement(&$element) {
	global $count;
	echo ($count++ % 10) ? $count . ' ' : PHP_EOL . $count . ' '; 
	$element = array('TEST');
	// need to call function recursively to continue adding levels
	// NOTE: this will throw off count because recursion invok
	addArrayToElement($element[0]);
}
$test = array('TEST');
addArrayToElement($test[0]);
