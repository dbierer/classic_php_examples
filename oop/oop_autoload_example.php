<?php
function myAutoloader($class)
{
	$filename = __DIR__ . DIRECTORY_SEPARATOR . str_ireplace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
	printf("Class: %s\nFilename: %s\n", $class, $filename);
	if (file_exists($filename)) {
		include $filename;
	} else {
		throw new Exception('Unable to locate file');
	}
}

// NOTE: alternatively you could change the function name to __autoload() and remove line 14
spl_autoload_register('myAutoloader');
use A\X\Test;
$t = new Test();
echo $t->getName();