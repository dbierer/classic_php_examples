<?php
// use DateInterval::invert to determine if a day is *before* or *after* another date
// here's sample code you can use:

$patt      = '%s is %d days %s %s' . PHP_EOL;
$date_now  = new DateTime('2023-11-01');
$date_item = new DateTime('2023-10-01');
$diff      = $date_item->diff($date_now);
$txt       = ($diff->invert === 1) ? 'after' : 'before';
printf($patt, $date_item->format('Y-m-d'), $diff->days, $txt, $date_now->format('Y-m-d'));
// Output: 2023-10-01 is 31 days before 2023-11-01

$date_now  = new DateTime('2023-10-01');
$date_item = new DateTime('2023-11-01');
$diff      = $date_item->diff($date_now);
$txt       = ($diff->invert === 1) ? 'after' : 'before';
printf($patt, $date_item->format('Y-m-d'), $diff->days, $txt, $date_now->format('Y-m-d'));
// Output: 2023-11-01 is 31 days after 2023-10-01
