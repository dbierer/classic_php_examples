<?php
// NOTE: not working yet!!!
// here is the database table structure:
/*
CREATE TABLE `world_city_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `iso2` char(2) DEFAULT NULL,
  `postal_code_prefix` char(8) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `state_province` varchar(64) DEFAULT NULL,
  `s_p_code` varchar(32) DEFAULT NULL,
  `county` varchar(64) DEFAULT NULL,
  `region_code_1` varchar(64) DEFAULT NULL,
  `region_code_2` varchar(64) DEFAULT NULL,
  `latitude` varchar(16) DEFAULT NULL,
  `longitude` varchar(16) DEFAULT NULL,
  `code` char(8) DEFAULT NULL,
  `region_code_3` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
*/

try {
	$dsn = 'mysql:dbname=zend;host=localhost';
	$pdo = new PDO($dsn, 'test', 'password', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	$pdo->exec('DELETE FROM world_city_data');
	$sql = 'INSERT INTO world_city_data '
	       . '(iso2, postal_code_prefix, city, state_province, s_p_code, county, region_code_1, region_code_2, region_code_3, latitude, longitude, code) '
	       . '(?,?,?,?,?,?,?,?,?,?,?,?)';
	$stmt = $pdo->prepare($sql);
	$fp = fopen('allCountries.txt', 'r');
	while (!feof($fp)) {
		$line = fgets($fp);
		echo $line;
		// country code \t postal code \t place name \t admin name1 \t admin code1 \t admin name2 \t admin code2 \t admin name3 \t admin code3 \t latitude \t longitude \t accuracy
		$fields = explode("\t", trim($line));
		$stmt->execute($fields);
	}
	fclose($fp);
} catch (PDOException $e) {
	echo $e->getMessage();
}
