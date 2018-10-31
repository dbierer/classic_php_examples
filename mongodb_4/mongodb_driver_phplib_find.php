<?php
// initialize env
require __DIR__ . '/vendor/autoload.php';
use MongoDB\Bson\Regex;
use Application\ {Client, Csv};

// set up mongodb client + collection
$params = ['host' => '127.0.0.1'];
$client = (new Client($params))->getClient();
$collection = $client->sweetscomplete->customers;

// here is the javascript query we wish to emulate:
/*
db.customers.find(
    {country:/UK/,balance:{$lt:100}},
    {_id:0,name:1,email:1,phone:1,balance:1}
).sort({balance:1});
*/

$filter = ['country' => new Regex('UK'), 'balance' => ['$lt' => 100]];
$projection = ['projection' => ['name' => 1, 'balance' => 1]];
try {
    $cursor = $collection->find($filter, $projection);
    foreach ($cursor as $document) {
        echo $document->name . ':' . $document->balance . PHP_EOL;
        var_dump($document->_id);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
