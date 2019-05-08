<?php
/*
 * Assumes this directory structure:
 *
 */

// Autoloader #1: array lookup
spl_autoload_register(
    function ($class) {
        echo "\nArray Lookup Autoloader\n";
        $classes = [
            'A\X\Test' => __DIR__ . '/A/X/Test.php'
        ];
        if (isset($classes[$class])) include_once $classes[$class];
    }
);

// Autoloader #2: builds path to file
spl_autoload_register(
    function ($class) {
        echo "Build Path Autoloader\n";
        $filename = __DIR__ . DIRECTORY_SEPARATOR . str_ireplace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        printf("Class: %s\nFilename: %s\n", $class, $filename);
        if (file_exists($filename)) {
            include $filename;
        } else {
            throw new Exception('Unable to locate file');
        }
    }
);

use A\X\ {Test, Whatever};
$t = new Test();
echo $t->getName();
$w = new Whatever();
echo $w->getName();
