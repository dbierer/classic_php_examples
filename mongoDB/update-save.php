<?php
// c-r-u-d-ops-update-save.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-data.php';

echo 'BEFORE --------------------------------------------' . PHP_EOL;
echo findAll($collection);

// Updates or adds
// db.test.update({name:'Cicero'},{name:'Cicero',balance:818.18,date:'2014-08-18'},{upsert:true})
$query   = array('name' => 'Cicero');
$update  = array('name' => 'Cicero', 'balance' => 818.18, 'date' => '2014-08-18');
$options = array('upsert' => TRUE);
$collection->update($query, $update, $options);

echo '1st UPDATE ----------------------------------------' . PHP_EOL;
echo findAll($collection);

// Updates or adds
// db.test.update({name:'Cicero'},{name:'Cicero',balance:919.19,date:'2014-08-18'},{upsert:true})
$query   = array('name' => 'Cicero');
$update  = array('name' => 'Cicero', 'balance' => 919.19, 'date' => '2014-08-18');
$options = array('upsert' => TRUE);
$collection->update($query, $update, $options);

echo '2nd UPDATE ----------------------------------------' . PHP_EOL;
echo findAll($collection);
