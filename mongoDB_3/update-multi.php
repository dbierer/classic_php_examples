<?php
// c-r-u-d-ops-update-multi.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-data.php';

// db.test.find()
echo 'BEFORE ------------------------------------' . PHP_EOL;
echo findAll($collection);

// NOTE: if "multi" is TRUE, updates all documents which match
// Updates ALL matches for "Mutt" or "Jeff"
// db.test.update({$or:[{name:"Mutt"},{name:"Jeff"}]},{$inc:{balance:-0.11}},true,true)
$query  = array('$or' => array(array('name' => 'Mutt'), array('name' => 'Jeff')));
$update = array('$inc' => array('balance' => -0.11));
// updates ALL matching documents
// NOTE: PHP driver uses "multiple" instead of the MongoDB shell "multi"
// NOTE: In the array of options you can also add "write concerns"
//       See: http://docs.mongodb.org/manual/core/write-concern/
//       See: http://www.php.net/manual/en/mongocollection.insert.php
//       See: http://www.php.net/manual/en/mongocollection.update.php
$options = array('multiple' => TRUE);
$collection->update($query, $update, $options);

// db.test.find()
echo 'AFTER -------------------------------------' . PHP_EOL;
echo findAll($collection);
