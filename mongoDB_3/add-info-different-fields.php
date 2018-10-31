<?php
// c-r-u-d-ops-add-info-different-fields.php

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// db.test.insert([{name:'Betty',balance:0.99},
//                 {name:'Veronica',balance:341958.22,vip:"DEFINITELY"}])
$document   = array(array('name' => 'Betty', 'balance' => 0.99),
					array('name' => 'Veronica', 'balance' => 999999.99, 'vip' => "YEP"),
                    array('name' => 'Archie', 'balance' => 0.01),
					array('name' => 'Reggie', 'balance' => 66666.66, 'vip' => "HE THINKS SO"));
// NOTE: different drivers have different methods for batch insert
$collection->batchInsert($document);

// db.test.find({vip:{$exists:1}})
$queryVip1 = array('vip' => array('$exists' => 1));
echo 'VIP TRUE: ' . PHP_EOL;
foreach($collection->find($queryVip1) as $item) {
	echo implode(':', $item) . PHP_EOL;
}

// db.test.find({vip:{$exists:0}})
$queryVip0 = array('vip' => array('$exists' => 0));
echo 'VIP FALSE: ' . PHP_EOL;
foreach($collection->find($queryVip0) as $item) {
	echo implode(':', $item) . PHP_EOL;
}
