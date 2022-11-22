<?php
$path = __DIR__ . '/*.txt';
$search = 'printf';
$list = glob(__DIR__ . '/*.php');
foreach ($list as $fn) {
	$found    = '';
	$contents = file($fn);
	foreach ($contents as $num => $line) {
		if (strpos($line, $search) !== FALSE) {
			$found .= printf("%4d : %s\n", $num, $line);
		}
	}
	echo "Scanned: $fn\n";
	echo $found;
}



