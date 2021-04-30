<?php
// c-r-u-d-ops-add-info-new-db.php

// NOTE: use newDB by itself does not create the new database!
//       you also need to add a document to a collection

// show databases
include 'c-r-u-d-ops-add-info-list-dbs.php';

// use newDB
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');

// new collection "test"
$collection = $db->selectCollection('test');

// NOTE: save() will also update if _id is the same
// db.test.save({name:"Laurel",balance:8.88})
$document   = array('name' => 'Laurel', 'balance' => 8.88);
$collection->save($document);

// NOTE: insert() will *only* insert
// db.test.insert({name:"Hardy",balance:9.99})
$document   = array('name' => 'Hardy', 'balance' => 9.99);
$collection->insert($document);

// db.test.find()
foreach($collection->find() as $item) {
	var_dump($item);
}

// show databases
include 'c-r-u-d-ops-add-info-list-dbs.php';
