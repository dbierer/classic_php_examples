<?php
$pattern = '/[\w]+/';
$value = 'cssClass_';
preg_match($pattern, $value, $matches);
var_dump($matches);
