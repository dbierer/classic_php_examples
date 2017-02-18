<?php
// DateTime examples
date_default_timezone_set('Europe/Berlin');
echo 'Current time: ' . date('Y-m-d H:i:s') . "\n";
$format = 'j-M-Y';
$date = DateTime::createFromFormat($format, '18-Aug-2011');
echo "Format: $format; " . $date->format('Y-m-d H:i:s') . "\n";
$format = 'D d M Y';
$date = DateTime::createFromFormat($format, 'Wed 18 Aug 2011');
echo "Format: $format; " . $date->format('Y-m-d H:i:s') . "\n";
$format = '!d';		// ! resets all fields; otherwise fields default to current
$date = DateTime::createFromFormat($format, '18');
echo "Format: $format; " . $date->format('Y-m-d H:i:s') . "\n";
$date = new DateTime();
echo $date->format('Y-m-d H:i:s') . "\n";
$date->setTime(14, 55);
echo $date->format('Y-m-d H:i:s') . "\n";
$date->setTime(14, 55, 24);
echo $date->format('Y-m-d H:i:s') . "\n";
