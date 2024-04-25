<?php
$minutes = 149;
echo $minutes
	 . ' minutes is '
	 . ((int) ($minutes / 60))
	 . ' hours and '
	 . ($minutes % 60)
	 . ' minutes'
	 . PHP_EOL;
// Output: 149 minutes is 2 hours and 29 minutes
