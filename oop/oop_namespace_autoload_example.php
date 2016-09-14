<?php
/*
 * Assumes you have a subdirectories ./A and ./A/X
 * and a file ./A/X/Test.php as follows:
 
namespace A\X;

class Test {
	public $name = 'X';
}

 */
//function __autoload($className)
function myAutoloader($className)
{
	$classFile = __DIR__ . DIRECTORY_SEPARATOR . str_ireplace('\\', DIRECTORY_SEPARATOR, $className) . '.php'; 
	echo $className . ':' . $classFile . PHP_EOL;
	require $classFile;
}
spl_autoload_register('myAutoLoader');
$a = new A\X\Test();
echo $a->getName();
echo PHP_EOL;
$b = new A\X\Whatever();
echo $b->abc;
echo PHP_EOL;
echo serialize($a);
