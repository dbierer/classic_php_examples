<?php
// this code inverts a CSV file
// 1. The top row headings become the 1st column headings
// 2. The column headings become the  1st row
// 3. All values are appropriately transposed

$src_fn   = __DIR__ . '/path/to/source.csv';
$src      = new SplFileObject($src_fn, 'r');
$dest_fn  = __DIR__ . '/path/to/inverted.csv';
$dest     = new SplFileObject($dest_fn, 'w');
$headers  = $src->fgetcsv();
array_shift($headers);
$body     = [];
while ($row = $src->fgetcsv()) {
    $key = trim($row[0] ?? '');
    if (empty($key)) continue;
    $body[$key] = array_slice($row, 1);
}

// write new headers
reset($body);
$inner = array_keys($body);
$dest->fputcsv([' ', ...$inner]);
foreach ($headers as $idx => $key) {
    $tmp[] = $key;
    foreach ($inner as $key) {
        $tmp[] = $body[$key][$idx];
    }
    $dest->fputcsv($tmp);
    $tmp = [];
}
unset($dest);
readfile($dest_fn);
