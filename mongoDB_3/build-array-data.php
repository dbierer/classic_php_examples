<?php
// c-r-u-d-ops-build-array-data.php

function findAll($collection, $query = array())
{
	// db.test.find()
	$output = '';
	foreach($collection->find($query) as $item) {
		$output .= sprintf('Name: %10s |  Amount |  Date', $item['name']) . PHP_EOL;
		foreach($item['purchases'] as $purchase) {
			$output .= vsprintf('                 | %7.2f | %10s', $purchase) . PHP_EOL;
		}
	}
	return $output;
}

// use mydb / customer
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// db.test.remove()
$collection->remove(); // removes all documents

// db.test.insert([{name:'Mutt',purchases:[{amount:111.11,date:'2014-01-01'},{etc.}]},
//                 {name:'Jeff',purchases:[{amount:444.44,date:'2014-04-04'},{etc.}]},
//                 {name:'MLove',purchases:[{amount:777.77,date:'2014-07-07'},{etc.}]})
$document   = array(array('name' => 'Mutt', 'purchases' => array(
												array('amount' => 111.11, 'date' => '2014-01-01'),
												array('amount' => 222.22, 'date' => '2014-02-02'),
												array('amount' => 333.33, 'date' => '2014-03-03'))),
					array('name' => 'Jeff', 'purchases' => array(
												array('amount' => 444.44, 'date' => '2014-04-04'),
												array('amount' => 555.55, 'date' => '2014-05-05'),
												array('amount' => 666.66, 'date' => '2014-06-06'))),
					array('name' => 'MLove', 'purchases' => array(
												array('amount' => 777.77, 'date' => '2014-07-07'),
												array('amount' => 888.88, 'date' => '2014-08-08'),
												array('amount' => 999.99, 'date' => '2014-09-09'))),
					);
$collection->batchInsert($document);
