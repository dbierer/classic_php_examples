<?php
$max = $_GET['max'] ?? $argv[1] ?? 100;
$max = (int) $max;
echo "Prime numbers up to $max\n";
for ($x = 5; $x < $max; $x++) {
    // This if evaluation checks to see if number is odd or even
    $test = TRUE;
    for($i = 3; $i < $x; $i++) {
        if(($x % $i) === 0) {
            $test = FALSE;
            break;
        }
    }
    if ($test) echo $x . ', ';
}
