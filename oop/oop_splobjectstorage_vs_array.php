<?php
// Tests Arrays vs. SplObjectStorage
/*
Update example of the original benchmark: 
    https://github.com/technosophos/Benchmarks-PHP/blob/master/SPLObjectStorage-vs-Arrays.php
See this article: 
     https://stackoverflow.com/questions/8520241/associative-array-versus-splobjectstorage
*/

$sos = new SplObjectStorage();
$docs = [];
$format = "%s:\nTime to fill: %0.12f.\nTime to check: %0.12f.\nMemory: %s\n\n";
$iterations = 100000;

for ($i = 0; $i < $iterations; ++$i) {
  $doc = new DOMDocument();
  $docs[] = $doc;
}
$start = $finis = 0;
$mem_empty = memory_get_usage();

// Load the SplObjectStorage
$start = microtime(TRUE);
foreach ($docs as $d) $sos->attach($d);
$finis = microtime(TRUE);
$time_to_fill = $finis - $start;

// Check membership on the object storage
$start = microtime(TRUE);
foreach ($docs as $d) $sos->contains($d);

// Record results
$finis = microtime(TRUE);
$time_to_check = $finis - $start;
$mem_spl = memory_get_usage();
$mem_used = $mem_spl - $mem_empty;
printf($format, 'SplObjectStorage', $time_to_fill, $time_to_check, number_format($mem_used));
unset($sos);
$mem_empty = memory_get_usage();

// Test arrays:
$start = microtime(TRUE);
$arr = array();

// Load the array
foreach ($docs as $d) {
  $arr[spl_object_hash($d)] = $d;
}
$finis = microtime(TRUE);
$time_to_fill = $finis - $start;

// Check membership on the array
$start = microtime(TRUE);
foreach ($docs as $d) {
  //$arr[spl_object_hash($d)];
  isset($arr[spl_object_hash($d)]);
}

// Record results
$finis = microtime(TRUE);
$time_to_check = $finis - $start;
$mem_arr = memory_get_usage();
$mem_used = $mem_arr - $mem_empty;
printf($format, 'Array', $time_to_fill, $time_to_check, number_format($mem_used));
