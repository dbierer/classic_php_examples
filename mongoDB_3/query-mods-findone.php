<?php
// c-r-u-d-ops-query-mods-findone.php

// db.customers.findOne({acct_balance:{$gt:100000}},{firstName:1,surname:1,_id:0})

// query
$query		= array('acct_balance' => array('$gt' => 100000));
$client		= new MongoClient();
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('customers');
$result     = $collection->findOne($query);

// results
var_dump($result);
