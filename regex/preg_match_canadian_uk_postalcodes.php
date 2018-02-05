<?php
$test[1] = 'A9A 9A9';	// Canadian = letter-number-letter space number-letter-number
$test[2] = 'PO8 9JP';	// UK = 2 letters + number + space + 1 or 2 numbers + 2 letters
$test[3] = '12345';		// bad
$test[4] = 'AA 49Q';	// bad
$pattern = '/([A-Z]\d[A-Z] \d[A-Z]\d)|([A-Z]{2}\d{1,2} \d{1,2}[A-Z]{2})/i';
foreach ($test as $item) {
	echo (preg_match($pattern, $item)) ? 'MATCH' : 'NO MATCH';
	echo PHP_EOL;
} 
?> 