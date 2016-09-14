<?php 
$password = "bad";  
echo "\n";
if (preg_match('/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', $password)) {
	echo "STRONG";
} else {	
	echo "WEAK"; 
} 
echo "\n";
?> 
