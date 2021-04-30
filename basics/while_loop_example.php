<?php
// performs an operation for 5 seconds
$interval = 5;      // seconds
$start = time();    // # seconds since 1-1-1970
$end   = $start + $interval;
$test  = $start;
$count = 0;
while($test < $end) {
    echo $count++ . ' ';
    $test = time();
}
echo "\n$count iterations in $interval seconds";
echo "\nStart: $start \nEnd: $test\n";
