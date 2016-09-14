<?php
// c-r-u-d-ops-query-mods-find-limit-one.php

// db.customers.find({acct_balance:{$gt:100000}},{firstName:1,surname:1,acct_balance:1,_id:0}).limit(3)

// query
$query		= array('acct_balance' => array('$gt' => 100000));
$projection = array('firstName' => 1, 'surname' => 1, 'acct_balance' => 1, '_id' => 0);
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('customers');
$limit		= 3;
$cursor     = $collection->find($query, $projection)->limit($limit);

// results
for ($x = 0; $x < $limit; $x++) {
	var_dump($cursor->getNext());
}
