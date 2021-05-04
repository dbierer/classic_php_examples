<?php 
header('Content-type: image/jpeg');
/*
$fh = fopen('gw.jpg',"r");
fpassthru($fh);
fclose($fh);
*/
// Alternate method
readfile('gw.jpg');
?>