<?php
$input = "i.was.going-to_try@this-one-next.co.uk";
$pattern = "/^[A-Za-z0-9\-\._]+@[\w\-_]+\.[\w\.{2,6}]+$/";
echo "\n";
echo preg_match($pattern,$input) ? "MATCH" : "NO MATCH";
echo "\n";
?>
