<?php
// c-r-u-d-ops-update-single.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-data.php';

echo 'BEFORE ------------------------------------' . PHP_EOL;
echo findAll($collection);

// NOTE: as long as "multi" is FALSE, updates only the 1st match
// Updates the first match for "Mutt" or "Jeff"
// db.test.update({$or:[{name:"Mutt"},{name:"Jeff"}]},{$inc:{balance:-50}},true,false)
$query   = array('$or' => array(array('name' => 'Mutt'), array('name' => 'Jeff')));
$update  = array('$inc' => array('balance' => -50));
$collection->update($query, $update);

echo 'AFTER -------------------------------------' . PHP_EOL;
echo findAll($collection);
