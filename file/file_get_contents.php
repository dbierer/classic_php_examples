<?php 
$contents = file_get_contents("http://www.google.com/");
//echo htmlentities($contents);
$contents = str_replace(
	array("Google","Lucky"),
	array("Boogle","Dizzy"),
	$contents);
echo $contents;
