<?php
$a = 'TEST';
$fn = 'test.txt';
/* Normal operation:
 * $fp = fopen($fn, 'w');
 * fwrite($fp, $a);
 * fclose($fp);
 */
$fileObj = new SplFileObject($fn, 'w');
$fileObj->fwrite($a, strlen($a));
unset($fileObj);
$fileObj = new SplFileObject($fn, 'r');
echo $fileObj->fgets();
