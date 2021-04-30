<?php
// c-r-u-d-ops-query-mods-sort.php

// looking for
$status 	= 'AAA';
$acct_bal 	= 30;

// connection
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('customers');

//  db.customers.find({status:"AAA",acct_balance:{$lt:30}},
//                    {_id:0,surname:1,country:1,status:1,acct_balance:1})
$query		= array('status' => $status, 'acct_balance' => array('$lt' => $acct_bal));
$projection = array('_id' => 0, 'surname' => 1, 'country' => 1, 'status' => 1, 'acct_balance' => 1);
//$cursor     = $collection->find($query, $projection);

// NOTE: 1 = ascending, -1 = descending
// <query>.sort({country:1,surname:1})
// <query>.sort({acct_balance:-1})
//$sort		= array('surname' => -1);
$sort		= array('country' => 1, 'acct_balance' => -1);
$cursor     = $collection->find($query, $projection)->sort($sort);

foreach($cursor as $item) {
	vprintf('%14s | %3s | %6.2f | %4s ', $item);
	echo PHP_EOL;
}

// db.customers.find({query}).count()
echo PHP_EOL;
echo 'TOTAL: ' . $collection->find($query)->count() . PHP_EOL;
