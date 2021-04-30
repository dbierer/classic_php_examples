<?php
// Shows immediate output
$filename = __DIR__ . '/gettysburg.txt';

echo "------- Example 1 ----------------\n";
$fp = fopen($filename, 'r');
if ($fp) {
	fpassthru($fp);
	fclose($fp);
} else {
	echo 'Unable to open file';
}

echo "------- Example 2 ----------------\n";
try {
	$fileObj = new SplFileObject($filename, 'r');
	$fileObj->fpassthru();
} catch (Exception $e) {
	echo $e->getMessage();
}

echo "------- Example 3 ----------------\n";
readfile($filename);

// Capture contents to variable
echo "------- Example 4 ----------------\n";
$fp = fopen($filename, 'r');
if ($fp) {
	$contents = fread($fp, filesize($filename));
	fclose($fp);
	echo $contents;
} else {
	echo 'Unable to open file';
}

echo "------- Example 5 ----------------\n";
try {
	$fileObj = new SplFileObject($filename, 'r');
	$contents = '';
	while(!$fileObj->eof()) {
		$contents .= $fileObj->current();
		$fileObj->next();
	}
	echo $contents;
} catch (Exception $e) {
	echo $e->getMessage();
}

echo "------- Example 6 ----------------\n";
$contents = file_get_contents($filename);
echo $contents;
