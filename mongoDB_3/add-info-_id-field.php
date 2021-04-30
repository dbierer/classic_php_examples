<?php
// c-r-u-d-ops-add-info-_id-field.php

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

$sample     = '-ABCDEFGHIJKLMNOPQRSTUVWXYZ';
for ($x = 1; $x < 27; $x++) {
	$auto[]   = array('name' => 'AUTO-' . substr($sample, $x, 1), 'idTest' => 'A');
}

// db.test.insert([{name:'AUTO-A',idTest:'A'},{name:'AUTO-B',idTest:'A'},etc.]) 
$collection->batchInsert($auto);

for ($x = 1; $x < 27; $x++) {
	$fixed[]   = array('_id' => $x, 'name' => 'FIXED-' . substr($sample, $x, 1), 'idTest' => 'F');
}

// db.test.insert([{_id:1,name:'FIXED-A',idTest:'F'},{_id:2,name:'FIXED-B',idTest:'F'},etc.]) 
$collection->batchInsert($fixed);

//db.test.find({idTest:{$exists:1}})
$query = array('idTest' => array('$exists' => 1));
foreach($collection->find($query) as $item) {
	var_dump($item) . PHP_EOL;
}
