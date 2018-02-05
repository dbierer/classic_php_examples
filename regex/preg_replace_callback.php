<?php

$callback = function ($matches) {
    if (is_array($matches)) $result = basename($matches[0]);
    else $result = NULL;
    return $result;
};
// here is the error message with directory info
$test = 'Notice: Undefined offset: 1 in /var/www/CodeArchive/application/files/php/basics/array_example.php on line 4';
// define pattern
$pattern = '|(/\w+)+\w+\.php|';
// Print results w/ only the filename
echo preg_replace_callback($pattern, $callback, $test);
// Actual Output: "Notice: Undefined offset: 1 in array_example.php on line 4"
