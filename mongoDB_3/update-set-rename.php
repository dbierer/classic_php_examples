<?php
// c-r-u-d-ops-update-set-rename.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-data.php';

// db.test.find()
echo 'BEFORE ------------------------------------' . PHP_EOL;
echo findAll($collection);

// NOTE: if "multi" is TRUE, updates all documents which match
// Updates ALL matches for "MLove"
// db.test.update({name:"MLove"},{$set:{name:"Mrs Mutt"}},true,true)
$query  = array('name' => 'MLove');
// $set operator assigns specified field specified value
$update = array('$set' => array('name' => 'Mrs Mutt'));

// updates ALL matching documents
// NOTE: PHP driver uses "multiple" instead of the MongoDB shell "multi"
$options = array('multiple' => TRUE);
$collection->update($query, $update, $options);

// db.test.update({},{$rename:{'name':'surname'}},true,true)
$query  = array();
// $rename operator changes field name
$update = array('$rename' => array('name' => 'surname'));

// updates ALL matching documents
// NOTE: PHP driver uses "multiple" instead of the MongoDB shell "multi"
$options = array('multiple' => TRUE);
$collection->update($query, $update, $options);

// db.test.find()
echo 'AFTER -------------------------------------' . PHP_EOL;
echo findAll($collection);
