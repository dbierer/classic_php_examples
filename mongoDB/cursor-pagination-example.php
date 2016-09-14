<?php
// c-r-u-d-ops-cursor-pagination-example.php

// db.customers.find({status:"AAA",country:"FR"}).skip(20).limit(20)

// looking for
$status		= 'AAA';
$country	= 'FR';

// paginate
$linesPerPg	= 20;
$page 		= (isset($_GET['page'])) ? (int) $_GET['page'] : 0;
$page		= (isset($argv[1])) ? (int) $argv[1] : $page;
$offset 	= $page * $linesPerPg;
echo $offset . PHP_EOL;

// query
$query		= array('status' => $status, 'country' => $country);
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('customers');
$total 		= $collection->find($query)->count();
$cursor     = $collection->find($query)->skip($offset)->limit($linesPerPg);

// iterate through results
$output[] 	= '       Surname |     First Name | Status | Country | Acct Balance' . PHP_EOL
			. '---------------|----------------|--------|---------|-------------'; 
foreach($cursor as $item) {
	$output[] = sprintf('%14s | %14s | %6s | %7s | %12.2f', 
						$item['surname'], 
						$item['firstName'], 
						$item['status'], 
						$item['country'], 
						$item['acct_balance']);
}

// produce output with pagination
echo $output[0] . PHP_EOL;
for ($x = 1; $x < count($output); $x++) {
	echo $output[$x] . PHP_EOL;
}
echo 'TOTAL DOCUMENTS IN QUERY: ' . $total . PHP_EOL;
