<?php
// c-r-u-d-ops-query-mods-find-in-array.php

// NOTE: population is recorded in billions

// set up connection
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('world_gdp');

// db.world_gdp.find({"population_est.2018":{$lt:0.5}},{country:1,population_est:1})
$query		= array('population_est.2018' => array('$lt' => 0.5));
$projection = array('country' => 1, 'population_est' => 1);
$cursor     = $collection->find($query, $projection)->limit(10);

// results
printf('%30s | %6d | %6d | %6d | %6d | %6d | %6d | %6d | %6d',
		'Country', 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018);
echo PHP_EOL;
foreach($cursor as $item) {
//	vprintf('%30s | %6.3f | %6.3f | %6.3f | %6.3f | %6.3f | %6.3f | %6.3f | %6.3f',
//			array_merge(array($item['country']), $item['population_est']));
	var_dump($item);
	echo PHP_EOL;
}
