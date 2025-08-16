<?php
// Performance Tip: put function calls outside of lengthy loops
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
$count = 0;
while ($count < count($arr)) {
    echo $arr[$count++] . ' ';
}
$end1 = microtime(TRUE);
// with function outside of loop
$top   = count($arr);
$start2 = microtime(TRUE);
$count = 0;
while ($count < $top) {
    echo $arr[$count++] . ' ';
}
$end2 = microtime(TRUE);
echo PHP_EOL;
echo '1st Elapsed Time: ' . ($end1 - $start1) . PHP_EOL;    // 0.86739587783813
echo '2nd Elapsed Time: ' . ($end2 - $start2) . PHP_EOL;    // 0.69204497337341

echo ($end2 - $start2) / ($end1 - $start1);
