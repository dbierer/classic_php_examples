<?php
// Insert code for makeArrayUpper() here
function makeArrayUpper($array){        
	$arrayUpper = array();        
	foreach($array as $key){            
		$arrayUpper[] = strtoupper($key);        
	}        
	return $arrayUpper;    
}


$array = explode(' ', 'Zend Training - Building Security into your PHP Application');
$array = makeArrayUpper($array);
var_dump($array);
?>	