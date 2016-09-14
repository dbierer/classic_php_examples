<?php
function overload() {
	$list = func_get_args();
	foreach ($list as $arg) {
		switch (TRUE) {
			case is_string($arg)	: $type[] = "String"; 	break;
			case is_int($arg) 		: $type[] = "Integer"; 	break;
			case is_float($arg) 	: $type[] = "Float"; 	break;
			case is_bool($arg) 		: $type[] = "Boolean"; 	break;
			case is_array($arg) 	: $type[] = "Array"; 	break;
			default					: $type[] = "Unknown";
		}
	}
	return $type;
}
$a = overload("Test",1,3.14,FALSE,array(1,2,3,4),NULL);
echo implode("\n",$a);
?>
