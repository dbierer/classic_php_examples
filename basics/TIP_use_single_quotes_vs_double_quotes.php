<?php
// Performance Tip: use single quotes instead of double
$max   = 1_000_000;
$alpha = range('A','Z');
$arr   = [];
// build the array
for ($x = 1; $x < $max; $x++) {
    $arr[$x] = $alpha[array_rand($alpha)];
    $arr[$x] .= $alpha[array_rand($alpha)];
    $arr[$x] .= $alpha[array_rand($alpha)];
    $arr[$x] .= $alpha[array_rand($alpha)];
}
// with function in loop
$start1 = microtime(TRUE);
foreach ($arr as $key => $value) {
    echo "$key = $value ";
}
$end1 = microtime(TRUE);
// with function outside of loop
$start2 = microtime(TRUE);
foreach ($arr as $key => $value) {
    echo $key . ' = ' . $value;
}
$end2 = microtime(TRUE);
$diff1 = $end1 - $start1;
$diff2 = $end2 - $start2;
echo PHP_EOL;
echo '1st Elapsed Time: ' . $diff1 . PHP_EOL;    // 1.0939869880676
echo '2nd Elapsed Time: ' . $diff2 . PHP_EOL;    // 0.75100588798523
echo 'Single quotes take ' . number_format(100 - (($diff2 / $diff1) * 100),2) . '% less time to process';
// actual output:
/*
1st Elapsed Time: 1.0939869880676
2nd Elapsed Time: 0.75100588798523
Single quotes take 31.35% less time to process
*/
