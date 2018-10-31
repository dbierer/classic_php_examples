<?php
// initialize env
require __DIR__ . '/vendor/autoload.php';
use MongoDB\BSON\ObjectId;
use Application\Client;

// set up mongodb client + collection
$params = ['host' => '127.0.0.1'];
$client = (new Client($params))->getClient();
$collection = $client->sweetscomplete->customers;

// here is the javascript query we wish to emulate:
/*
db.customers.updateOne(
    {_id:ObjectId("5b47108b533b8406ac227798")},
    {$set:{balance:99.99}}
);
*/

$filter = ['_id' => new ObjectId('5b47108b533b8406ac227798')];
try {
    $document = $collection->findOne($filter);
    // Check if the result is a BSONDocument. If not, then document was not found.
    if ($document instanceof MongoDB\Model\BSONDocument) {
        printf("Name: %s | Old Balance: %.2f\n", $document->name, $document->balance);
        $data = ['$set' => ['balance' => 99.99]];
    } else {
        throw new Exception('Document not found!');
    }

    $result = $collection->updateOne($filter, $data);
    // Check if the result is a BSONDocument. If not, then document was not found.
    if ($document instanceof MongoDB\Model\BSONDocument) {
        printf("Matched %d document(s)\n", $result->getMatchedCount());
        printf("Modified %d document(s)\n", $result->getModifiedCount());
    } else {
        throw new Exception('Document not found!');
    }

    $document = $collection->findOne($filter);
    // Check if the result is a BSONDocument. If not, then document was not found.
    if ($document instanceof MongoDB\Model\BSONDocument) {
        printf("Name: %s | New Balance: %.2f\n", $document->name, $document->balance);
    } else {
        throw new Exception('Document not found!');
    }
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
