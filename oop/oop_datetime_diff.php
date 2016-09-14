<?php
// compares differences between dates
$old  = new DateTime(date('Y') . '-01-01');
$now  = new DateTime();
$new1 = new DateTime((date('Y') + 1) . '-01-01');
$new2 = new DateTime((date('Y') + 2) . '-01-01');

// if $now is more recent than $old, "invert" = 1
echo 'Now <---> YYYY-01-01' . PHP_EOL;
var_dump($now->diff($old));

// if $old is older than $now, "invert" = 0
echo 'YYYY-01-01 <---> Now' . PHP_EOL;
var_dump($old->diff($now));

echo 'Now <---> Now' . PHP_EOL;
var_dump($now->diff($now));

echo 'Now <---> YYYY+1-01-01' . PHP_EOL;
var_dump($now->diff($new1));

echo 'Now <---> YYYY+2-01-01' . PHP_EOL;
var_dump($now->diff($new2));
