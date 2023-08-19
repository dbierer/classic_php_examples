<?php
$str_putcsv = function (array $arr) : string {
    ob_start();
    fputcsv(STDOUT, $arr);
    $str = ob_get_contents();
    ob_end_clean();
    return $str;
};

$contents = file('doug.csv');
$str = $contents[1];
$arr = str_getcsv($str);
echo $str . PHP_EOL;
var_dump($arr);
echo $str_putcsv($arr) . PHP_EOL;