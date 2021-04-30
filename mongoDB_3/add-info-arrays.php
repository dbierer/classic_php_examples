<?php
// c-r-u-d-ops-add-info-arrays.php

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// db.test.insert([{name:'Road Runner',wins:[2001,2002,2003,2004,2005,2006],losses:[]}, 
//                 {name:'Wiley Coyote',wins:[],losses:[2001,2002,2003,2004,2005,2006]}])
$document   = array(array('name'   => 'Road Runner', 
                          'wins'   => array(2001,2002,2003,2004,2005,2006), 
                          'losses' => array()),
					array('name'   => 'Wiley Coyote',
					      'wins'   => array(), 
					      'losses' => array(2001,2002,2003,2004,2005,2006)));

// NOTE: different drivers have different methods for batch insert
$collection->batchInsert($document);

// db.test.find({wins:{$exists:1}})
$query = array('wins' => array('$exists' => 1));
foreach($collection->find($query) as $item) {
	var_dump($item) . PHP_EOL;
}
