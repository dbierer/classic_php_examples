<?php
declare(strict_types=1);
spl_autoload_register(function ($class) {
	echo __FILE__ . ':' . __LINE__ . ':' . $class . "\n";
	$fn = str_replace('\\', '/', $class) . '.php';
	require __DIR__ . '/' . $fn;
});
use A\X\Child;
$temp = new Child();
$temp->setFname('Fred');
$temp->lname = 'Flintstone';
echo $temp->getInfo();
echo "\n";
var_dump($temp->getArrayCopy());
var_dump(get_object_vars($temp));

$temp = new Child();
$temp->setFname('Wilma');
$temp->lname = 'Flintstone';
echo $temp->getInfo();
echo "\n";

