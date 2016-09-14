<?php
$value = 'OUTSIDE INCLUDE.PHP';
include 'include.php';
// Uncomment the line below; error will be generated
//include 'include.php';
// Uncomment the line below; no error will be generated
include_once 'include.php';
echo timesTwo(4);
echo '<br />' . PHP_EOL;
echo SOME_VALUE . '<br />' . PHP_EOL;
highlight_file('include.php');
$test  = new Test();
$a = 'ABC';
echo '<pre>';
var_dump($GLOBALS);
echo '</pre>';
?>