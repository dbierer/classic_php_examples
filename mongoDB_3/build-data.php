<?php
// c-r-u-d-ops-build-data.php

function findAll($collection)
{
	// db.test.find()
	$output = '';
	foreach($collection->find() as $item) {
		foreach($item as $key => $value) {
			if (strlen($value) > 12) {
				$output .= sprintf(' | %8s : %24s', $key, $value);
			} else {
				$output .= sprintf(' | %8s : %10s', $key, $value);
			}
		}
		$output .= PHP_EOL;
	}
	$output .= PHP_EOL;
	return $output;
}

// use mydb / customer
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// db.test.remove()
$collection->remove(); // removes all documents

// db.test.insert([{name:'Mutt',balance:111.11,date:'2014-01-01'},etc.
//                 {name:'Jeff',balance:444.44,date:'2014-04-04'}, etc.
//                 {name:'MLove',balance:777.77,date:'2014-07-07'}, etc.])
$document   = array(array('name' => 'Mutt', 'balance' => 111.11, 'date' => '2014-01-01'),
					array('name' => 'Mutt', 'balance' => 222.22, 'date' => '2014-02-02'),
					array('name' => 'Mutt', 'balance' => 333.33, 'date' => '2014-03-03'),
					array('name' => 'Jeff', 'balance' => 444.44, 'date' => '2014-04-04'),
					array('name' => 'Jeff', 'balance' => 555.55, 'date' => '2014-05-05'),
					array('name' => 'Jeff', 'balance' => 666.66, 'date' => '2014-06-06'),
					array('name' => 'MLove', 'balance' => 777.77, 'date' => '2014-07-07'),
					array('name' => 'MLove', 'balance' => 888.88, 'date' => '2014-08-08'),
					array('name' => 'MLove', 'balance' => 999.99, 'date' => '2014-09-09'),);
$collection->batchInsert($document);
