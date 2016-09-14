<?php
// c-r-u-d-ops-add-info-_id-field-find.php

// First run "c-r-u-d-ops-add-info-_id-field.php"
// which does this:
// db.test.insert([{name:'AUTO-A',idTest:'A'},{name:'AUTO-B',idTest:'A'},etc.]) 
// db.test.insert([{_id:1,name:'FIXED-A',idTest:'F'},{_id:2,name:'FIXED-B',idTest:'F'},etc.]) 

// use newDB / test
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('newDB');
$collection = $db->selectCollection('test');

// Finding a document where _id was overwritten is easy:

echo 'db.test.find({_id:8})' . PHP_EOL;
$query = array('_id' => 8);
var_dump($collection->findOne($query));
echo PHP_EOL;

// MUCH BETTER: just use any unique field to find documents:
echo 'db.test.find({name:AUTO-Q})' . PHP_EOL;
$query = array('name' => 'AUTO-Q');
var_dump($collection->findOne($query));
echo PHP_EOL;

// If you *really* want to search by the auto-generated _id
// you would have to create a javascript function
// which introspects each ObjectID and converts to a string
// which can then be searched:
$id = (isset($_GET['id'])) ? $_GET['id'] : 0; // HTML
$id = ($id) ? $id : $argv[1];
echo <<<EOT
db.system.js.save({_id:"findByObjectId",
                    value:
                       function(id) {
                         cursor=db.customers.find();
                         while(cursor.hasNext()){
                           doc=cursor.next();
                           if(doc._id.toString().indexOf(id)>0){
                             return doc;
                           }
                        }
                       }
                   })
db.eval("findByObjectId('$id')")

EOT;

// in PHP you would do something like this:
// NOTE: this is *highly inefficient*!!!
$cursor = $collection->find();
while($cursor->hasNext()) {
	$doc = $cursor->getNext();
	$_id  = $doc['_id'];
	if ($_id && $_id instanceof MongoID && $id == $_id->__toString()) {
		var_dump($doc);
		echo PHP_EOL;
		break;
	}
}
