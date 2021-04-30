<?php

$time_start = microtime(true);
 
for ( $i = 0; $i < 100000; ++$i )
{
   $results = strcmp('string' . $i, 'string' . $i);
}
 
$time_end = microtime(true);
printf("strcmp with matching strings took %f seconds\n", $time_end - $time_start);
 
$time_start = microtime(true);
 
for ( $i = 0; $i < 100000; ++$i )
{
   $results = strcmp('string' . $i, 'string' . (string)($i + 1));
}
 
$time_end = microtime(true);
printf("strcmp with non-matching strings took %f seconds\n", $time_end - $time_start);
 
$time_start = microtime(true);
 
for ( $i = 0; $i < 100000; ++$i )
{
   $results = ('string' . $i) === ('string' . $i);
}
 
$time_end = microtime(true);
printf("=== with matching strings took %f seconds\n", $time_end - $time_start);
 
$time_start = microtime(true);
 
for ( $i = 0; $i < 100000; ++$i )
{
   $results = ('string' . $i) === ('string' . (string)($i + 1));
}
 
$time_end = microtime(true);
printf("=== with non-matching strings took %f seconds\n", $time_end - $time_start);

$time_start = microtime(true);
 
for ( $i = 0; $i < 100000; ++$i )
{
   $results = ('string' . $i) == ('string' . $i);
}
 
$time_end = microtime(true);
printf("== with matching strings took %f seconds\n", $time_end - $time_start);
 
$time_start = microtime(true);
 
for ( $i = 0; $i < 100000; ++$i )
{
   $results = ('string' . $i) == ('string' . (string)($i + 1));
}
 
$time_end = microtime(true);
printf("== with non-matching strings took %f seconds\n", $time_end - $time_start);
