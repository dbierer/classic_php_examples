<?php
// c-r-u-d-ops-cursor-example.php
// command line usage: c-r-u-d-ops-cursor-pagination-example.php [status] [country] [acct_balance]
// browser usage: c-r-u-d-ops-cursor-pagination-example.php&?status=[status]&country=[country]&acct_balance=[acct_balance]

// db.customers.find({status:"AAA",country:"FR",acct_balance:{$lt:1000}})

// looking for
$status 	= (isset($_GET['status'])) ? strtoupper(substr($_GET['status'], 0, 3)) : 'AAA';
$status		= (isset($argv[1])) ? strtoupper(substr($argv[1], 0, 3)) : $status;
$country 	= (isset($_GET['country'])) ? strtoupper(substr($_GET['country'], 0, 2)) : 'FR';
$country	= (isset($argv[2])) ? strtoupper(substr($argv[2], 0, 2)) : $country;
$acct_bal 	= (isset($_GET['acct_bal'])) ? (float) $_GET['acct_bal'] : 1000;
$acct_bal	= (isset($argv[3])) ? (float) $argv[3] : $acct_bal;

// query
$linesPerPg	= 12;
$query		= array('status' => $status, 'country' => $country, 'acct_balance' => array('$lt' => $acct_bal));
$client		= new MongoClient(); // connect
$db 		= $client->selectDB('mydb');
$collection = $db->selectCollection('customers');
$total 		= $collection->find($query)->count();
$cursor     = $collection->find($query)->limit($linesPerPg);

// produce output
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
echo '<pre>' . PHP_EOL;
echo $output[0] . PHP_EOL;
for ($x = 1; $x < count($output); $x++) {
	echo $output[$x] . PHP_EOL;
}
echo 'TOTAL DOCUMENTS IN QUERY: ' . $total . PHP_EOL;
echo 'command line usage: c-r-u-d-ops-cursor-pagination-example.php [status] [country] [acct_balance]' . PHP_EOL;
echo 'browser usage: c-r-u-d-ops-cursor-pagination-example.php&?status=[status]&country=[country]&acct_balance=[acct_balance]' . PHP_EOL;
echo '</pre>' . PHP_EOL;
