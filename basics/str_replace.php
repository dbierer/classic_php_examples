<?php
$var = 2;
$str = 'aabbccddeeaabbccdd';
echo str_replace('a', 'z', $str, $var);
echo PHP_EOL;
var_dump($var);