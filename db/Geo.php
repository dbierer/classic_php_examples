<?php
namespace Geonames;
use PDO;
use SplFileObject;
class Geo
{

	// `zipcodes` table column names => geoname fields
	// NOTE: this is a primitive form of mapping (e.g. Domain Model)
	public $mapping = [
		'ZIPCode'    => 'postal_code',
		'CityName'   => 'place_name',
		'CountyName' => 'admin_name2',
		'CountyFIPS' => 'admin_code2',
		'StateName'  => 'admin_name1',
		'StateAbbr'  => 'admin_code1',
		'Latitude'   => 'latitude',
		'Longitude'  => 'longitude',
	];

	// geoname fields in the order they're read in via CSV
	public $fields = [
		'country_code',
		'postal_code',
		'place_name',
		'admin_name1',
		'admin_code1',
		'admin_name2',
		'admin_code2',
		'admin_name3',
		'admin_code3',
		'latitude',
		'longitude',
		'accuracy',
	];

    /**
     * Updates `zipcodes` table from geonames data
     *
     * @param PDO $pdo
     * @param array $geo == geonames ZIP code data read into an array
     * @param SplFileObject $exp == exceptions file
     * @param int $offset == offset into insert
     * @return array $result == ['success' => bool, 'expected' => int, 'actual' => int]
     */
    public function updateZip(PDO $pdo, array $geo, SplFileObject $exp, int $offset)
    {

        // prepare insert SQL
        $baseSql = 'INSERT INTO `zipcodes` (`';
        $baseSql .= implode('`,`', array_keys($this->mapping));
        $baseSql .= '`) VALUES (:';
        $baseSql .= implode(',:', array_keys($this->mapping));
        $baseSql .= ')';
        $stmt = $pdo->prepare($baseSql);

        // init vars
        $actual   = 0;
        $expected = 0;
        $maxCols  = count($this->fields);
        $maxGeo   = count($geo);

        try {
            // loop through each line (tab delimited)
            for ($x = 0; $x < self::CHUNK_SIZE; $x++) {
                $line = $geo[$x + $offset];
                $expected++;
                $go  = TRUE;
                $row = str_getcsv($line, "\t");
                if (count($row) != $maxCols) {
                    if (count($row) == ($maxCols - 1)) {
                        $row[] = 0;
                    } else {
                        $exp->fputcsv($row);
                        $go = FALSE;
                    }
                }
                if ($go) {
                    // array_combine with $fields
                    $geonames = array_combine($this->fields, $row);
                    $data = [];
                    // loop through $mapping
                    foreach ($this->mapping as $key => $value) {
                        // if $value, add value from $geonames array
                        if (!empty($value) && is_string($value) && strlen(trim($value))) {
                            $data[$key] = (isset($geonames[$value])) ? $geonames[$value] : '';
                        } else {
                            // if no value, add empty string
                            $data[$key] = $value;
                        }
                    }
                    // exec prepared statement using $data
                    $stmt->execute($data);
                    $actual++;
                }
            }
        } catch (Exception $e) {
            $exp->fwrite($e->getMessage() . PHP_EOL);
        }
        $success = ($expected == $actual);
        return ['success' => $success, 'expected' => $expected, 'actual' => $actual];
    }

}