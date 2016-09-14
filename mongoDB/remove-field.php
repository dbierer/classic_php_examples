<?php
// c-r-u-d-ops-remove-field.php

// creates $collection and inserts fake data
include 'build-data.php';

echo 'BEFORE --------------------------------------------' . PHP_EOL;
echo findAll($collection);

// adds a field to all documents
echo 'db.test.update({},{$set:{status:"INDIGENT"}},false,true)' . PHP_EOL;
$query   = array();
$update  = array('$set' => array('status' => 'INDIGENT'));
$options = array('multiple' => TRUE);
$collection->update($query, $update, $options);

echo 'FIELD ADDED ---------------------------------------' . PHP_EOL;
echo findAll($collection);

// removes a field from documents with a balance >= 500
echo 'db.test.update({balance:{$gte:500}},{$unset:{status:1}},false,true)' . PHP_EOL;
$query   = array('balance' => array('$gte' => 500));
$update  = array('$unset' => array('status' => 1));
$options = array('multiple' => TRUE);
$collection->update($query, $update, $options);

echo 'FIELD REMOVED -------------------------------------' . PHP_EOL;
echo findAll($collection);
