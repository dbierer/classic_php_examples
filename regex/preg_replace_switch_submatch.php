<?php
$string         = 'April 15, 2018';
$pattern        = '/(\w+) (\d+), (\d+)/i';
$replacement    = '$2 $1 $3';
echo preg_replace($pattern, $replacement, $string) . PHP_EOL;
$string         = 'Jones, John';
$pattern        = '/(\w+), (\w+)/i';
$replacement    = '$2 $1';
echo preg_replace($pattern, $replacement, $string);
