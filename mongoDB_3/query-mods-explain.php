<?php
// c-r-u-d-ops-query-mods-explain.php

// NOTE: population is recorded in billions

// set up connection
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
// ERROR: collection should be "world_gdp"
$collection = $db->selectCollection('customers');

// db.world_gdp.find({"population_est.2018":{$lt:1}},{country:1,population_est:1}).limit(10)
$query		= array('acct_balance' => array('$lt' => 100));
$projection = array('surname' => 1, 'firstName' => 1, 'acct_bal' => 1);
$cursor     = $collection->find($query, $projection)->explain();

// results
var_dump($cursor);
