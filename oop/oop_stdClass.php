<?php

// "stdClass" is the parent of all PHP classes
// In a sense, ANY object in PHP extends this class
// Thus, to say "extends stdClass" is redundant

class Hello {
//class Hello extends stdClass {
	
	function say ($something) {
		echo $something . "\n";
	}
}

// Create an instance of the class "Hello"
$a = new Hello();

// Execute the method (function) "say" of the class "Hello"
$a->say("Hello World");

?>