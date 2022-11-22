<?php
/*
 * Assumes this directory structure:
 *
 */
$mapping = [
	'A\X\Test' => __DIR__ . '/A/X/Test.php',
	'A\X\Whatever' => __DIR__ . '/A/X/Whatever.php',
];

spl_autoload_register(
    function ($class) use ($mapping) {
		if (isset($mapping[$class])) {
			echo $class . ':' . $mapping[$class] . PHP_EOL;
			include $mapping[$class];
		}
    }
);
use A\X\ {Test, Whatever};
$t = new Test();
echo $t->getName();
$w = new Whatever();
echo $w->getName();
