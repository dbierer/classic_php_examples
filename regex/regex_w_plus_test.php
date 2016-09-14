<?php
$regexp = "/[\w\.]+/";

$a = array("adfd", ".", "+");

foreach ($a as $b) {
    echo $b . ": ";
    echo preg_match($regexp, $b, $matches) ? "MATCH" : "NO MATCH";
    echo "\n";
}

?>
