<?php
// 2011-01-21 DB: uses streams to create a gzip compressed file + read it back again
$sourceFile = 'gettysburg.txt';
$destFile = 'gettysburg.gz';
if (file_exists($sourceFile)) {
	// get current directory
	$dir = __DIR__;
	// reads a text file gettysburg.txt into $contents
	$contents = file_get_contents($dir . DIRECTORY_SEPARATOR . $sourceFile);
	// write file out as gzip compressed using 'compress.zlib' stream
	file_put_contents('compress.zlib://' . $dir . DIRECTORY_SEPARATOR . $destFile, $contents);
	// read gzipped file back again
	$contents = file_get_contents('compress.zlib://' . $dir . DIRECTORY_SEPARATOR . $destFile);
	// display unzipped contents
	echo $contents;
} else {
	// display message if source file not found
	echo "SORRY: unable to open source file $sourceFile!";
}
?>
