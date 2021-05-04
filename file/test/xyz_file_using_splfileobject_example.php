<?php
$fn = __DIR__ . '/doug.csv';

// Traditional Approach:
$fh = fopen($fn, 'r');
while (!feof($fh)) {
	$line = fgetcsv($fh);
	vprintf('%10s : %5s : %5s : %5s : %5s', $line) . PHP_EOL;
}
fclose($fh);

// OOP approach:
$fileObj = new SplFileObject($fn, 'r');
while (!$fileObj->eof()) {
	$line = $fileObj->fgetcsv();
	echo implode(' : ', $line) . PHP_EOL;
}
$fileObj = NULL;
