<?php
// c-r-u-d-ops-add-info-objects-in-objects.php

// NOTE: requires PHP 5.4
date_default_timezone_set('Europe/London');

// NOTE: public properties become fields
//       methods are not stored, only properties
class Profile
{
	public $name;
	public $balance;
	public $type = 'OBJECT';
	public $date;
	public function __construct($name, $balance)
	{
		$this->name   = $name;
		$this->balance = $balance;
		$this->date   = new DateTime();
	}
}

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// db.test.insert([{name:'Clark Kent',balance:444.44,type:'OBJECT',date:<object>}, 
//                 {name:'Lois Lane',balance:555.55,type:'OBJECT',date:<object>}])

$document   = array(new Profile('Clark Kent', 444.44),
					new Profile('Lois Lane',  555.55));

// NOTE: different drivers have different methods for batch insert
$collection->batchInsert($document);

//db.test.find({$and:[{balance:{$gt:400}},{balance:{$lt:600}}]})
// NOTE: using PHP 5.4 array syntax
$query = ['$and' => [['balance' => ['$gt' => 400]],['balance' => ['$lt' => 600]]]];
foreach($collection->find($query) as $item) {
	var_dump($item) . PHP_EOL;
}



