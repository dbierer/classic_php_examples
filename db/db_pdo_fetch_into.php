<?php
// Results are placed into Custmoer via FETCH_INTO fetch mode
// Assumes you have both PDO and pdo_sqlite enabled + sqlite3 installed

// Uses this table (see db_pdo_build_sqlite_demo_db.php)
/*
CREATE TABLE customers (id INTEGER, first_name TEXT, last_name TEXT);
INSERT INTO customers VALUES(1,'Fred','Flintstone');
INSERT INTO customers VALUES(2,'Wilma','Flintstone');
INSERT INTO customers VALUES(3,'Barney','Rubble');
INSERT INTO customers VALUES(4,'Betty','Rubble');
*/

// Define Customer class
class Customer
{
	public function getFullName() : string
	{
		return $this->first_name
			   . ' '
			   . $this->last_name
			   . PHP_EOL;
	}
}

$db = __DIR__ . '/demo.db';

try {

	$result = NULL;
	$cust   = new Customer();
	$dbh = new PDO('sqlite://' . $db);

	// Run query
	$sql = "SELECT * FROM customers";
	$sth = $dbh->query($sql);

	// fetches "into" an object
	$sth->setFetchMode(PDO::FETCH_INTO, $cust);
	while ($obj = $sth->fetch()) echo $obj->getFullName();

} catch (Throwable $t) {

	echo $t->getMessage();

}

// output:
/*
Fred Flintstone
Wilma Flintstone
Barney Rubble
Betty Rubble
*/
