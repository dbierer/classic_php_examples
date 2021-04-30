<?php
/*
 * Assumes this directory structure:
 *
 */
spl_autoload_register(
    function ($class) {
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
