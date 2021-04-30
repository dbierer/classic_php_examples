<?php
$a = 'The quick brown fox jumped over the fence.';
if (stripos($a, 'The')) {
	echo 'Found It!';
} else {
	echo 'Not Found';
}
echo PHP_EOL;
if (stripos($a, 'The') !== FALSE) {
	echo 'Found It!';
} else {
	echo 'Not Found';
}
