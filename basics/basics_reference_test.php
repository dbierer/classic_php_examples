<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$a = "TEST\n";
$b =& $a;
echo "1\n";
echo $a;
echo $b;
$b = "XYZ\n";
echo "2\n";
echo $a;
echo $b;
// $b is destroyed
unset($b);
// what is the effect on $a?
echo "3\n";
echo $a;
// back to start
$a = "TEST\n";
$b =& $a;
echo "4\n";
echo $a;
echo $b;
// $a is destroyed
unset($a);
// what is the effect on $b?
echo "5\n";
echo $b;
echo $a;