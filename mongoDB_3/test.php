<?php
// c-r-u-d-ops-cursor-dump.php

// NOTE: performance is enhanced is find() is based on index field(s)

// looking for
$status 	= 'AAA';
$country 	= 'FR';
$acct_bal 	= 1000;

// connection
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('customers');

// db.customers.find({status:"AAA",country:"FR",acct_balance:{$lt:1000}})
$query		= array('status' => $status, 'country' => $country, 
					'acct_balance' => array('$lt' => $acct_bal));
$projection = array('firstName' => 1, 'surname' => 1);
$sort		= array('surname' => 1);
$cursor     = $collection->find($query, $projection)->sort($sort)->limit(20);

$item = $cursor->getNext();
while($item) {
	echo $item['firstName'] . ' ' . $item['surname'] . PHP_EOL;
	$item = $cursor->getNext();
}

// db.customers.find({query}).count()
echo PHP_EOL;
echo 'TOTAL: ' . $collection->find($query)->count() . PHP_EOL;
