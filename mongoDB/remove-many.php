<?php
// c-r-u-d-ops-remove-many.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-data.php';

echo 'BEFORE --------------------------------------------' . PHP_EOL;
echo findAll($collection);

// removes just one document where the balance is less than 500
echo 'db.test.remove({balance:{$lt:500}},{justOne:0})' . PHP_EOL;
$query   = array('balance' => array('$lt' => 500));
$options = array('justOne' => FALSE);
$collection->remove($query, $options);

echo 'AFTER ---------------------------------------------' . PHP_EOL;
echo findAll($collection);
