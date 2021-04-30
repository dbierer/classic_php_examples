<?php
header("Content-Type: image/jpeg");
$fn = "gw.jpg";
function ex1($fn) {
	$a = file_get_contents($fn);
	echo $a;
}
function ex2($fn) {
	readfile($fn);
}
function ex3($fn) {
	$fh = fopen($fn,"r");
	fpassthru($fh);
	fclose($fh);
}
ex2($fn);
?>
