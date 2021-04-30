<?php
// Complete the pattern for a US Social Security Number
$input = '111-22-3333-5566';
$pattern = '/^\d{3}-\d{2}-\d{4}$/';
echo "\n";
echo preg_match($pattern,$input) ? "MATCH" : "NO MATCH";
echo "\n";
?>
