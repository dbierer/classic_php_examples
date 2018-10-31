<?php
// c-r-u-d-ops-add-info-batch-insert.php

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// db.test.insert([{name:'Mutt',balance:1.11},
//                 {name:'Jeff',balance:2.22}])
$document   = array(array('name' => 'Mutt', 'balance' => 1.11),
					array('name' => 'Jeff', 'balance' => 2.22));
// NOTE: different drivers have different methods for batch insert
$collection->batchInsert($document);

// db.test.find()
foreach($collection->find() as $item) {
	echo implode(':', $item) . PHP_EOL;
}
