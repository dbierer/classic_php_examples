<?php
// updates the `zipcodes` table from geonames.org data
ini_set('max_execution_time', 300);
ini_set('display_errors', 1);
define('OK_TO_RUN', 1);
define('WHO_IS_THIS', 'remote');
define('SOURCE_DIR', __DIR__);
include __DIR__ . '/Geo.php';
use Geonames/Geo;

// init vars
$geo      = [];
$exp      = NULL;
$success  = FALSE;
$expected = 0;
$actual   = 0;
// need to download and unzip from Geonames:
// https://download.geonames.org/export/zip/US.zip
$txtFile  = SOURCE_DIR . '/data/US.txt';
$expFile  = SOURCE_DIR . '/data/exceptions.csv';

// handle params
$page     = (isset($_GET['page']))     ? (int) $_GET['page']     : 0;
$expSave  = (isset($_GET['expected'])) ? (int) $_GET['expected'] : 0;
$actSave  = (isset($_GET['actual']))   ? (int) $_GET['actual']   : 0;
$offset   = Geo::CHUNK_SIZE * $page;

// set up PDO + prepared statement + files
echo "\n<pre>\n";
echo "\nProcessing " . basename(__FILE__) . "\n";
try {
    $exp = new SplFileObject($expFile, 'w');
    // write headers out to exceptions file
    $exp->fputcsv($fields);
    // set up PDO
    $params = include SOURCE_DIR . '/db_params.php';
    $pdo = new PDO($params['dsn'], $params['username'], $params['password'], $params['options']);
    // truncate `zipcodes` table if 1st pass
    if ($page === 0) $pdo->exec('DELETE FROM `zipcodes`');
    $result   = Geo::updateZip($pdo, $geo, $exp, $offset);
    $expected += $result['expected'];
    $actual   += $result['actual'];
} catch (Exception $e) {
    $exp->fwrite($e->getMessage() . PHP_EOL);
}

// calculate expected / actual
$expSave += $expected;
$actSave += $actual;

echo '<br><a href="?page=' . ++$page . "&expected=$expSave&actual=$actSave\">NEXT</a>\n";
echo ($expected == $actual) ? 'SUCCESS' : 'FAILED';
echo ": Entries Processed:\n";
echo "Expected:\t" . $expSave . PHP_EOL;
echo "Actual  :\t" . $actSave   . PHP_EOL;
echo "\nException Report:\n";
readfile($expFile);
echo "\n</pre>\n";

// close files
unset($pdo);
unset($geo);
unset($exp);

// data structure
/*
CREATE TABLE `zipcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ZIPCode` varchar(5) NOT NULL DEFAULT '',
  `CityName` varchar(64) NOT NULL DEFAULT '',
  `CountyName` varchar(64) NOT NULL DEFAULT '',
  `CountyFIPS` varchar(5) NOT NULL DEFAULT '',
  `StateName` varchar(64) NOT NULL DEFAULT '',
  `StateAbbr` char(2) NOT NULL DEFAULT '',
  `Latitude` decimal(9,6) NOT NULL DEFAULT '0.000000',
  `Longitude` decimal(9,6) NOT NULL DEFAULT '0.000000',
  PRIMARY KEY (`id`),
  KEY `ZIPCode` (`ZIPCode`),
  KEY `ZIPCode_2` (`ZIPCode`,`Latitude`,`Longitude`)
) ENGINE=MyISAM AUTO_INCREMENT=80013 DEFAULT CHARSET=latin1;
*/

// geonames data structure (see: https://download.geonames.org/export/zip/)
/*
country_code      : iso country code, 2 characters
postal_code       : varchar(20)
place_name        : varchar(180)
admin_name1       : 1. order subdivision (state) varchar(100)
admin_code1       : 1. order subdivision (state) varchar(20)
admin_name2       : 2. order subdivision (county/province) varchar(100)
admin_code2       : 2. order subdivision (county/province) varchar(20)
admin_name3       : 3. order subdivision (community) varchar(100)
admin_code3       : 3. order subdivision (community) varchar(20)
latitude          : estimated latitude (wgs84)
longitude         : estimated longitude (wgs84)
accuracy          : accuracy of lat/lng from 1=estimated, 4=geonameid, 6=centroid of addresses or shape
*/