<?php
// DateTime ignores TZ data if you use a UNIX timestamp
// Note in the var_dump() results that 0 and 1 are the same
// whereas they should be different
// however 2 and 3 are different because the timezone was set later

$time   = time(); // UNIX timestamp
$today  = new DateTime('@' . $time);
$date[] = new DateTime('@' . $time, new DateTimeZone('PST'));
$date[] = new DateTime('@' . $time, new DateTimeZone('UTC'));
$date[] = (clone $today)->setTimeZone(new DateTimeZone('PST'));
$date[] = (clone $today)->setTimeZone(new DateTimeZone('UTC'));
var_dump($date);

// results
/*
array(4) {
  [0]=>
  object(DateTime)#2 (3) {
    ["date"]=>
    string(26) "2021-08-20 07:13:45.000000"
    ["timezone_type"]=>
    int(1)
    ["timezone"]=>
    string(6) "+00:00"
  }
  [1]=>
  object(DateTime)#3 (3) {
    ["date"]=>
    string(26) "2021-08-20 07:13:45.000000"
    ["timezone_type"]=>
    int(1)
    ["timezone"]=>
    string(6) "+00:00"
  }
  [2]=>
  object(DateTime)#4 (3) {
    ["date"]=>
    string(26) "2021-08-19 23:13:45.000000"
    ["timezone_type"]=>
    int(2)
    ["timezone"]=>
    string(3) "PST"
  }
  [3]=>
  object(DateTime)#5 (3) {
    ["date"]=>
    string(26) "2021-08-20 07:13:45.000000"
    ["timezone_type"]=>
    int(3)
    ["timezone"]=>
    string(3) "UTC"
  }
}
*/
