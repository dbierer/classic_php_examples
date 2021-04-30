<?php
class Senior {
	const FLAG = "Parent";
	function __construct () {
		echo "\nLine 05: " . self::FLAG;
	}
}
class Junior extends Senior {
	const FLAG = "Child";
}
$s = new Senior();
$j = new Junior();
echo "\nLine 13: " . Senior::FLAG;
echo "\nLine 14: " . Junior::FLAG;
?>
