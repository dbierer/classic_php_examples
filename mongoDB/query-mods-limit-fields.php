<?php
// c-r-u-d-ops-query-mods-limit-fields.php

// db.customers.find({acct_balance:{$gt:100000}},{firstName:1,surname:1,acct_balance:1,_id:0})

// query
$query		= array('acct_balance' => array('$gt' => 100000));
$projection = array('firstName' => 1, 'surname' => 1, 'acct_balance' => 1, '_id' => 0);
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('customers');
$cursor     = $collection->find($query, $projection);

// iterate through results
$item = $cursor->getNext();
while($item) {
	for ($x = 0; $x < 3; $x++) {
		vprintf('%14s, %14s %9.2f |', $item);
		$item = $cursor->getNext();
		if (!$item) { break; }
	}
	$item = $cursor->getNext();
	echo PHP_EOL;
}

// db.customers.find({query}).count()
echo PHP_EOL;
echo 'TOTAL: ' . $collection->find($query)->count() . PHP_EOL;
