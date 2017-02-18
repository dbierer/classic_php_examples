<?php
// date, DateInterval, DateTime
date_default_timezone_set('America/Los_Angeles');
// different preset datetime formats
echo date(DateTime::COOKIE) . "<br />\n";
echo date(DateTime::RSS) . "<br />\n";
// creates date object, defaults to today
$date = new DateTime();
// add 7 days (i.e. 1 week) to today
$date->add(new DateInterval('P7D'));
echo $date->format('Y-m-d') . "<br />\n";
?>
