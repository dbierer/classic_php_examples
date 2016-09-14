<?php 
// ^ inside [] means "not"
echo (preg_match("/[^A-Z0-9-]/i", "DS-11")) 					? "TRUE\n" : "FALSE\n"; 
echo (preg_match("/[^A-Z0-9-]/i", "DS-11-<hahaha></hahaha>")) 	? "TRUE\n" : "FALSE\n"; 
?>
