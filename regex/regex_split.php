<?php
// split the phrase by any number of commas or space characters,
// which include " ", \r, \t, \n and \f
$str = file_get_contents("gettysburg.txt");
//$chars = preg_split('/[\s\W]+/', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);
$chars = preg_split('/[\b\s]/', $str, -1, PREG_SPLIT_OFFSET_CAPTURE);
print_r($chars);
?>
