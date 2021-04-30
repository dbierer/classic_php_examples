<?php
// initialize env
require __DIR__ . '/vendor/autoload.php';
use Application\ {Client, Csv};

// set up mongodb client + collection
$params = ['host' => '127.0.0.1'];
$client = (new Client($params))->getClient();
$collection = $client->sweetscomplete->customers;

// empty out collection
$collection->drop();
$collection = $client->sweetscomplete->customers;

// set up CSV file processing
$csv = new Csv(__DIR__ . '/sweets_customers.csv');

// perform inserts
$insert = [];
foreach ($csv->getIteratorWithHeaders() as $data) {
    $data['balance'] = (float) $data['balance'];
    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    $insert[] = $data;
}

try {
    $result = $collection->insertMany($insert);
    echo $result->getInsertedCount() . ' documents inserted' . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
}
