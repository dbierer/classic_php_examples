<?php
// c-r-u-d-ops-add-info-arrays-find.php

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// searching a numeric / simple array
echo 'db.test.find({wins:{$in:[2001]}})' . PHP_EOL;
$query = array('wins' => array('$in' => array(2001)));
var_dump($collection->findOne($query)) . PHP_EOL;

// searching an associative array
echo 'db.test.find({movies.title:"Avatar"})' . PHP_EOL;
$query = array('movies.title' => 'Avatar');
var_dump($collection->findOne($query)) . PHP_EOL;
