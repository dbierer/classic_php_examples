<?php
// c-r-u-d-ops-add-info-objects.php

// NOTE: public properties become fields
//       methods are not stored, only properties
class Profile
{
	public $name;
	public $wins;
	public $losses;
	public $type = 'OBJECT';
	public function __construct($name, array $wins, array $losses)
	{
		$this->name   = $name;
		$this->wins   = $wins;
		$this->losses = $losses;
	}
}

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');
$collection->drop();

// db.test.insert([{name:'Road Runner',wins:[2001,2002,2003,2004,2005,2006],losses:[],type:'OBJECT'}, 
//                 {name:'Wiley Coyote',wins:[],losses:[2001,2002,2003,2004,2005,2006],type:'OBJECT'}])

$document   = array(new Profile('Road Runner', array(2001,2002,2003,2004,2005,2006),array()),
					new Profile('Wiley Coyote', array(), array(2001,2002,2003,2004,2005,2006)));

// NOTE: different drivers have different methods for batch insert
$collection->batchInsert($document);

// find syntax is the same as looking for info in an array
echo 'db.test.find({wins:{$in:[2001]}})' . PHP_EOL;
$query = array('wins' => array('$in' => array(2001)));
var_dump($collection->findOne($query)) . PHP_EOL;





