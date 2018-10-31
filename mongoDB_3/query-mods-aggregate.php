<?php
// c-r-u-d-ops-query-mods-aggregate.php

// connection
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('world_gdp');

// db.world_gdp.aggregate({$group:{_id:"$country",gdp:{$sum:"$gdp"}}},
//                        {$match:{gdp:{$gte:2500}}},{$sort:{gdp:-1}})
$group		= array('$group' => array('_id' => '$country', 'gdp' => array('$sum' => '$gdp')));
$match		= array('$match' => array('gdp' => array('$gte' => 2500)));
$sort		= array('$sort'  => array('gdp' => -1));
$aggregate  = array($group, $match, $sort);
$result     = $collection->aggregate($aggregate);

var_dump($result);
