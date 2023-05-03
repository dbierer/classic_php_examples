<?php
// Results are placed into Custmoer via FETCH_INTO fetch mode
// Assumes you have both PDO and pdo_sqlite enabled + sqlite3 installed

/*
CREATE TABLE customers (id INTEGER, first_name TEXT, last_name TEXT);
INSERT INTO customers VALUES(1,'Fred','Flintstone');
INSERT INTO customers VALUES(2,'Wilma','Flintstone');
INSERT INTO customers VALUES(3,'Barney','Rubble');
INSERT INTO customers VALUES(4,'Betty','Rubble');
*/

$db = __DIR__ . '/demo.db';
$data = [
	[1,'Fred','Flintstone'],
	[2,'Wilma','Flintstone'],
	[3,'Barney','Rubble'],
	[4,'Betty','Rubble'],
];

try {

	$pdo = new PDO('sqlite://' . $db);

	// Repopulate table
	$pdo->exec('DELETE FROM customers');
	$stmt = $pdo->prepare('INSERT INTO customers (id, first_name, last_name) VALUES (?,?,?)');

	// do inserts
	$actual = 0;
	$expected = 0;
	foreach ($data as $row) {
		$expected++;
		$actual += (int) $stmt->execute($row);
	}

	echo "Expected insert rows: $expected \n";
	echo "Actual rows inserted: $actual \n";

} catch (Throwable $t) {

	echo $t->getMessage();

}
