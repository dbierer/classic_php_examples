<?php
$s = fopen("http://www.unlikelysource.com/","r");
//$s = fopen("file:///var/www/php_exp/doug.csv","r");
$a = stream_get_wrappers();
$b = stream_get_filters();
$c = stream_get_transports();
$d = stream_get_meta_data($s);
fclose($s);
echo "\nWrappers:\n";
var_dump($a);
echo "\nFilters:\n";
var_dump($b);
echo "\nTransports:\n";
var_dump($c);
echo "\nMeta Data:\n";
var_dump($d);
?>
