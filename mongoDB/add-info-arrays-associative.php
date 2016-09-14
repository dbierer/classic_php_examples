<?php
// c-r-u-d-ops-add-info-arrays-associative.php

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// db.test.insert([{name:'James Cameron',
//                  movies:[{title:"Avatar",year:2009},
//                          {title:"Titanic",year:1997},
//                          {title:"True Lies",year:1994}]},
//                 {name:'Ridley Scott',
//                  movies:[{title:"Prometheus",year:2012},
//                          {title:"Hannibal",year:2001},
//                          {title:"Black Hawk Down",year:2001},
//                          {title:"Blade Runner",year:1982}]}])

$document = array(
  array('name' => 'James Cameron',
		'movies' => array(array('title' => "Avatar", 'year' => 2009),
						  array('title' => "Titanic", 'year' => 1997),
						  array('title' => "True Lies", 'year' => 1994))),
  array('name' => 'Ridley Scott',
		'movies' => array(array('title' => "Prometheus", 'year' => 2012),
						  array('title' => "Hannibal", 'year' => 2001),
						  array('title' => "Black Hawk Down", 'year' => 2001),
						  array('title' => "Blade Runner", 'year' => 1982))),
);

// NOTE: different drivers have different methods for batch insert
$collection->batchInsert($document);

// NOTE: array elements appear as sub-documents
// db.test.find({movies:{$exists:1}})
$query = array('movies' => array('$exists' => 1));
foreach($collection->find($query) as $item) {
	var_dump($item) . PHP_EOL;
}
