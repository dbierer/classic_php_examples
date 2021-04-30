<?php
spl_autoload_register(function ($class) {
    $fn = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    require $fn;
});

use Classes\ {TestPublic, TestProtected};

$format = '<br><pre>%s</pre>' . PHP_EOL;
$test[] = new TestProtected('Marge', 99.99);
$test[] = new TestProtected('Lisa', 88.88);
$test[] = new TestProtected('Crusty the Clown', -99.99);
$test[] = new TestPublic('Homer', 99.99);
$test[] = new TestPublic('Bart', 88.88);
$test[] = new TestPublic('Mo', -99.99);

// serialize works OK on either class
$string = serialize($test);
printf($format, $string);

// unserialize works OK on either class
$obj = unserialize($string);
printf($format, var_export($obj, TRUE));

// json_encode() only works when object properties are public!
$json = json_encode($test);
printf($format, $json);

// json_decode() does not return original class!!!
$native = json_decode($json);
printf($format, var_export($native, TRUE));
