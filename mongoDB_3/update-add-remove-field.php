<?php
// c-r-u-d-ops-update-add-remove-field.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-data.php';

echo 'BEFORE --------------------------------------------' . PHP_EOL;
echo findAll($collection);

// adds a field to all documents
// db.test.update({},{$set:{status:'INDIGENT'}},false,true)
$query   = array();
$update  = array('$set' => array('status' => 'INDIGENT'));
$options = array('multiple' => TRUE);
$collection->update($query, $update, $options);

echo 'FIELD ADDED ---------------------------------------' . PHP_EOL;
echo findAll($collection);

// removes a field from certain documents
// db.test.update({name:'MLove'},{$unset:{status:1}},false,true)
$query   = array('name' => 'MLove');
$update  = array('$unset' => array('status' => 1));
$options = array('multiple' => TRUE);
$collection->update($query, $update, $options);

echo 'FIELD REMOVED -------------------------------------' . PHP_EOL;
echo findAll($collection);
