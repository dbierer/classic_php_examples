<?php
// Here's how to perform the equivalent of the perl expression:
// tr/ABC/abc/
$pattern = array("/A/","/B/","/C/");
$replace = array("a","b","c");
$input = "Uppercase 'ABC' becomes lowercase 'A', 'B', and 'C'.\n";
echo preg_replace($pattern, $replace, $input);
echo "<br>\n";
// But here's a more practical example
$pattern = array("/;/","/</","/>/");
$replace = array('&#x3b;','&lt;','&gt;');
$input = "<script language=javascript>Insert Hacker Code Here;</script>";
echo preg_replace($pattern, $replace, $input);
?>
