<?php
// c-r-u-d-ops-query-mods-distinct.php

// db.customers.distinct("city", { acct_balance:{$gt:100000}})

// query
$query		= array('acct_balance' => array('$gt' => 100000));
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('customers');
$cursor     = $collection->find($query)->limit(1);

// results
var_dump($cursor->getNext());
