<?php
// objective: use preg_replace_callback to strip out 
// sensitive directory info in error message

// define callback function which accepts $matches = input from preg_replace
function returnBasename($matches) {
	if (is_array($matches)) {
		$result = basename($matches[0]);
	} else {
		$result = NULL;
	}
	return $result;
}
// here is the error message with directory info
$test = 'Notice: Undefined offset: 1 in /var/www/CodeArchive/application/files/php/basics/array_example.php on line 4';
// Create regex        
$pattern = '|(/\w+)+\w+\.php|';
// Print results w/ only the filename
echo preg_replace_callback($pattern, 'returnBasename', $test);
?>
