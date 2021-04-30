<?php
// let's look at the output of the microtime() command
echo microtime();
// now let's break it up using the ' ' as a split point
$micro_secs = explode(' ', microtime());
echo PHP_EOL;
echo "\nvar_dump of output from explode():\n\n";
var_dump($micro_secs);
echo PHP_EOL;
// parse array elements into variables using list()
list($usec, $sec) = explode(' ', microtime());
echo "$sec seconds\n$usec  microseconds\n";
?>