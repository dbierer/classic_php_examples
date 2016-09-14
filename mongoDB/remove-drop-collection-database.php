<?php
// c-r-u-d-ops-remove-drop-collection-database.php

function showDatabases($client)
{
	$list = $client->listDBs();
	$dbList = array();
	foreach($list['databases'] as $db) {
		$dbList[] = $db['name'];
	}
	return 'Databases: ' . implode(', ', $dbList) . PHP_EOL;
}

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-data.php';

// show databases
echo showDatabases($client);

// show collections
$db = $client->selectDB('newDB');
echo 'Collections for "newDB": ' . implode(', ', $db->getCollectionNames()) . PHP_EOL;

echo 'BEFORE --------------------------------------------' . PHP_EOL;
echo findAll($collection);

// remove all documents from the collection
echo 'db.collection.remove()' . PHP_EOL;
$collection->remove();

echo 'AFTER REMOVE() -------------------------------' . PHP_EOL;
echo findAll($collection);

echo 'Collections for "newDB": ' . implode(', ', $db->getCollectionNames()) . PHP_EOL;

// drop collection
echo 'db.collection.drop()' . PHP_EOL;
$collection->drop();
echo PHP_EOL;

echo 'AFTER DROP() ---------------------------------' . PHP_EOL;
echo 'Collections for "newDB": ' . implode(', ', $db->getCollectionNames()) . PHP_EOL;
echo PHP_EOL;

// drop database
echo 'db.drop()' . PHP_EOL;
$client->dropDB('newDB');

// show databases
echo showDatabases($client);
