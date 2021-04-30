<?php
// initialize env
require __DIR__ . '/vendor/autoload.php';
use MongoDB\BSON\ {Regex, ObjectId};
use Application\Client;

// set up mongodb client + collection
$params = ['host' => '127.0.0.1'];
$client = (new Client($params))->getClient();
$collection = $client->sweetscomplete->customers;

// here is the javascript query we wish to emulate:
// db.customers.find({name:/Spencer/});

$filter = ['name' => new Regex('Spencer')];
try {
    $document = $collection->findOne($filter);
    // Check if the result is a BSONDocument. If not, then document was not found.
    if ($document instanceof MongoDB\Model\BSONDocument) {
        echo $document->name . PHP_EOL;
        var_dump($document->_id);
    } else {
        throw new Exception('Document not found!');
    }
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}

// here is the javascript query we wish to emulate:
// db.customers.find(ObjectId("5b47108b533b8406ac227798"));

$filter = ['_id' => new ObjectId('5b47108b533b8406ac227798')];
try {
    $document = $collection->findOne($filter);
    // Check if the result is a BSONDocument. If not, then document was not found.
    if ($document instanceof MongoDB\Model\BSONDocument) {
        echo $document->name . PHP_EOL;
        var_dump($document->_id);
    } else {
        throw new Exception('Document not found!');
    }
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}
