<?php 
$a = 10;
$b = "10";
echo ($a == $b) ? "T" : "F";
echo PHP_EOL;
echo ($a === $b) ? "T" : "F";
echo PHP_EOL;
echo ($a = $b) ? "T" : "F";
echo PHP_EOL;
$b = 0;
echo ($a = $b) ? "T" : "F";
?>
