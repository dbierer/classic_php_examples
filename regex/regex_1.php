<?php
//$input = "The quick brown fox jumped over the fence.";
$input = 'www.unlikelysource.123';
$pattern = "/\.[a-z]{3,4}$/";
echo "\n";
echo preg_match($pattern,$input) ? "MATCH" : "NO MATCH";
echo "\n";
?>
