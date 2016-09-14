<?php
// c-r-u-d-ops-add-info-list-dbs.php

// create connection
$mongo		= new Mongo();

// show databases
// this needs to be executed from an existing database
// "admin" and "local" always exist and can be used if you have the rights
$dbList = $mongo->admin->command(array('listDatabases' => 1));

// output list
echo '-------------------------------------' . PHP_EOL;
echo '      Name |     Size     |     Empty' . PHP_EOL;
echo '-------------------------------------' . PHP_EOL;
foreach ($dbList['databases'] as $item) {
	printf('%10s | ', $item['name']);
	printf('%12s | ', $item['sizeOnDisk']);
	printf('%8d', $item['empty']);
	echo PHP_EOL;
}
echo '-------------------------------------' . PHP_EOL;
