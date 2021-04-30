<?php
// get name of collection
$collection = $argv[1] ?? $_GET['collection'] ?? NULL;
$dropFirst  = $argv[2] ?? $_GET['drop_first'] ?? FALSE;

if (!$collection) exit ('Collection not specified ... exiting');

// set up as a *.js file
$out  = '';
$out .= 'conn = new Mongo();' . PHP_EOL;
$out .= 'db = conn.getDB("sweetscomplete");' . PHP_EOL;

// drop first?
if ($dropFirst) {
    $out .= 'db.' . $collection . '.drop();' . PHP_EOL;
}

// process headers
$csv  = new SplFileObject(__DIR__ . DIRECTORY_SEPARATOR . 'sweets_' . $collection . '.csv', 'r');
$headers = $csv->fgetcsv();
$numFields = count($headers);

// process data from CSV file
while ($row = $csv->fgetcsv()) {
    // only take complete rows
    if (isset($row[0]) && count($row) == $numFields) {
        // convert any numeric data to float
        foreach ($row as $key => $item)
            if (ctype_digit($item))
                $row[$key] = (float) $row[$key];

        // create assoc array
        $data = array_combine($headers, $row);
        $out .= 'db.' . $collection . '.insertOne(' . PHP_EOL
              . json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL
              . ');' . PHP_EOL;
    }
}
echo $out;
