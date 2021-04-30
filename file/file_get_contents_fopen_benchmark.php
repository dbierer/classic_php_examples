<?php 
function addTime($microtime) {
	return preg_replace('/(\.\d+) (\d+)/', '\2\1', $microtime);
}

$time1 = microtime();
$contents1 = file_get_contents('gettysburg.txt');
$time2 = microtime();
$contents2 = '';
$fh = fopen('gettysburg.txt', 'r');
while(!feof($fh)) {
	$contents2 .= fgets($fh);
}
fclose($fh);
$time3 = microtime();
printf("\nStart Time ------------------------------ %f", addTime($time1));
printf("\nfile_get_contents --------------------- %f", (addTime($time2) - addTime($time1)));
printf("\nfopen ------------------------------------ %f", (addTime($time3) - addTime($time2)));
?>
