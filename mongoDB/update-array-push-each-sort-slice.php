<?php
// c-r-u-d-ops-update-array-push-each-sort-slice.php

// creates $collection and inserts fake data
include 'c-r-u-d-ops-build-array-data.php';

// db.test.find()
echo 'BEFORE ------------------------------------' . PHP_EOL;
echo findAll($collection);

// db.test.update( { name: "Jeff" },
//                 { $push: { purchases: { $each: [ { amount: 1111.11, date: '2014-11-11' },
//                                                  { amount: 1212.12, date: '2014-12-12' } ],
//                                         $sort: { amount: -1 },
//                                         $slice: -4
//                                       }
//                           }
//                  }
//               )

$query  = array('name' => 'Jeff');
$update = 
	array('$push' => 
		array('purchases' => 
			array(
				'$each' => array(
					array('amount' => 1111.11, 'date' => '2014-11-11'),
					array('amount' => 1212.12, 'date' => '2014-12-12')),
				// takes only the 4 largest amounts
				'$sort' => array('amount' => -1),
				'$slice' => -5
				)
			)
);
$collection->update($query, $update);

// db.test.find()
echo 'AFTER -------------------------------------' . PHP_EOL;
echo findAll($collection);
