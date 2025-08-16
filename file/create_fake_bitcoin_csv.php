<?php
// 1,14227,59838,6.93,2011-04-28-09-01-4
$rand_date = function () {
    $y = rand(2000, 2026);
    $m = rand(1, 12);
    if ($m == 2) {
        $d = 28;
    } elseif ($m == 4 || $m = 6 || $m = 9) {
        $d = 30;
    } else {
        $d = 31;
    }
    $d = rand(1, $d);
    $hr = rand(0, 23);
    $mn = rand(0, 60);
    $sc = rand(0, 60);
    return sprintf('%4d-%02d-%02d-%02d-%02d-%02d', $y, $m, $d, $hr, $mn, $sc);
};
$max = 1000;
$obj = new SplFileObject('bitcoin.csv', 'w');
for ($x = 1; $x < $max; $x++) {
    $data = [
        $x,
        rand(1000, 999999),
        rand(1000, 999999),
        number_format((rand(1, 9999) / 100), 2),
        $rand_date()
    ];
    $obj->fputcsv($data, ',');
}
