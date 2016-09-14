<?php
// c-r-u-d-ops-update-array-value.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-array-data.php';

echo 'BEFORE --------------------------------------------' . PHP_EOL;
echo findAll($collection);

// Updates the purchase for "Jeff" where the purchase date is 2014-04-04
//  db.test.update({name:"Jeff","purchases.date":"2014-04-04"},
//                 {$inc:{"purchases.$.amount":44.44}})
$query   = array('name' => 'Jeff', 'purchases.date' => '2014-04-04');

$update  = array('$inc' => array('purchases.$.amount' => 44.44));
$collection->update($query, $update);

echo 'AFTER ---------------------------------------------' . PHP_EOL;
echo findAll($collection,$query);
