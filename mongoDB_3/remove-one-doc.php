<?php
// c-r-u-d-ops-remove-one-doc.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-data.php';

echo 'BEFORE --------------------------------------------' . PHP_EOL;
echo findAll($collection);

// removes specific document
echo 'db.test.remove({name:"Mutt",date:"2014-02-02"})' . PHP_EOL;
$query   = array('name' => 'Mutt', 'date' => '2014-02-02');
$collection->remove($query);

echo 'MUTT 2014-01-01 REMOVED ---------------------------' . PHP_EOL;
echo findAll($collection);

// removes just one document with the name matching "Jeff"
echo 'db.test.remove({name:"Jeff"},{justOne:1})' . PHP_EOL;
$query   = array('name' => 'Jeff');
$options = array('justOne' => TRUE);
$collection->remove($query, $options);

echo '1ST JEFF REMOVED ----------------------------------' . PHP_EOL;
echo findAll($collection);
