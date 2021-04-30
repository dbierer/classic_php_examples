<?php
// Complete the pattern to validate a URL
$input = "http://www.bbc.co.uk/sample/test";
//$pattern = "/^((http|https|ftp|ftps):\/\/)?(\w+\.)+\w{2,6}(\/.*)*$/";
$pattern = "/(\w+\.)+/";
echo "\n";
echo preg_match_all($pattern,$input,$matches) ? "MATCH" : "NO MATCH";
echo "\n";
var_dump($matches);
?>
