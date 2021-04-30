<?php
use MongoDB\BSON\Binary;
use MongoDB\Driver\ {Manager, BulkWrite, Query};

// Target URL: http://www.sciencekids.co.nz/images/pictures/flags96/Afghanistan.jpg
$imagePattern = 'http://www.sciencekids.co.nz/images/pictures/flags96/%s.jpg';
$contents = file_get_contents('http://www.sciencekids.co.nz/pictures/flags.html');
$pattern = '!img src="../images/pictures/flags96/(.+?).jpg" alt="Flag of (.+?)" width="96!';
preg_match_all($pattern, $contents, $matches);
$flags = new ArrayIterator(array_combine($matches[1],$matches[2]));

// setup MongoDB connection
$manager = new Manager('mongodb://localhost/mongodb_quickstart');
$bulk    = new BulkWrite(['ordered' => true]);

$startWith = 'C';
foreach ($flags as $img => $name) {
    if ($name[0] != $startWith) continue;
    echo 'Processing Flag for ' . $name . PHP_EOL;
    $imageSrc = sprintf($imagePattern, $img);
    $imageBson = new Binary(file_get_contents($imageSrc), Binary::TYPE_GENERIC);
    // add to bulk insert
    $bulk->insert(['country' => $name, 'image' => $imageBson]);
}

// execute bulk write
try {
    $result = $manager->executeBulkWrite('mongodb_quickstart.flags', $bulk);
    echo 'Inserted ' . $result->getInsertedCount() . ' documents' . PHP_EOL;
} catch (MongoDB\Driver\Exception\BulkWriteException $e) {
    $result = $e;
}

// view results
var_dump($result);
