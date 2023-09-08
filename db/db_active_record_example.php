<?php
class ActiveRecord
{
    const TABLE  = 'need_to_change';
    const PRIMARY_KEY = 'primary_key_column';
    const FIELDS = [ 'Change', 'Me' ];
    const ERR_ROW = 'ERROR: column count does not match';
    const ERR_CSV = 'ERROR: problem with CSV file';
    public array $row = [];
    /**
     * @param array $row : should be a numeric array from CSV or database
     * @return void
     */
    public function __construct(array $row)
    {
        $this->ingestRow($row);
    }
    /**
     * @param array $row : should be a numeric array from CSV or database
     * @throws LengthException : if row counts don't match
     * @return void
     */
    public function ingestRow(array $row) : void
    {
        if (count(static::FIELDS) !== count($row))
            throw new LengthException(static::ERR_ROW);
        // check to see if not numeric array
        if (count($row) > 0 && empty($row[0])) $row = array_values($row);
        $this->row = array_combine(static::FIELDS, $row);
    }
    /**
     * Inserts this product instance into database
     * @param PDO $pdo : PDO instance
     * @throws PDOException
     * @return bool : TRUE if insert was successful
     */
    public function insert(PDO $pdo) : bool
    {
        $sql = 'INSERT INTO ' . static::TABLE . ' '
             . '(' . implode(',', static::FIELDS) . ') '
             . 'VALUES '
             . '(:' . implode(',:', static::FIELDS) . ');';
        $pdo->prepare($sql);
        return $pdo->execute($this->row);
    }
    /**
     * Updates this product instance in the database
     * @param PDO $pdo : PDO instance
     * @param mixed $key : Primary key (e.g. product code) value
     * @throws PDOException
     * @return bool : TRUE if update was successful
     */
    public function update(PDO $pdo, $key) : bool
    {
        $sql = 'UPDATE ' . static::TABLE . ' SET ';
        foreach (static::FIELDS as $field)
            $sql .= $field . '=:' . $field;
        $sql[-1] = ' ';
        $sql .= 'WHERE ' . static::PRIMARY_KEY . '=:' . static::TABLE . '_key;';
        $pdo->prepare($sql);
        $row = $this->row;
        $row[static::TABLE . '_key'] = $key;
        return $pdo->execute($row);
    }
    /**
     * Deletes this product instance from the database
     * @param PDO $pdo : PDO instance
     * @param mixed $key : Primary key (e.g. product code) value
     * @throws PDOException
     * @return bool : TRUE if delete was successful
     */
    public function delete(PDO $pdo, $key) : bool
    {
        $sql = 'DELETE FROM ' . static::TABLE . ' '
             . 'WHERE ' . static::PRIMARY_KEY . '=:' . static::TABLE . '_key;';
        $pdo->prepare($sql);
        $row[static::TABLE . '_key'] = $key;
        return $pdo->execute($row);
    }
    /**
     * Retrieves a row from the database
     * @param PDO $pdo : PDO instance
     * @param mixed $key : Primary key (e.g. product code) value
     * @throws PDOException
     * @return array : returns the database row + updates $this->row; if unsuccessful, returns empty array
     */
    public function select(PDO $pdo, $key) : array
    {
        $sql = 'SELECT ' . implode(',', static::FIELDS) . ' FROM ' . static::TABLE . ' '
             . 'WHERE ' . static::PRIMARY_KEY . '=:' . static::TABLE . '_key;';
        $pdo->prepare($sql);
        $row[static::TABLE . '_key'] = $key;
        if ($stmt = $pdo->execute($row)) {
            $row = $stmt->fetch(PDO::FETCH_NUM);
        } else {
            $row = [];
        }
        $this->row = $row;
        return $row;
    }
}

class User extends ActiveRecord
{
    const TABLE  = 'users';
    const PRIMARY_KEY = 'ID';
    // 1,WILFREDO,RICHARDS,"129 Lazy Bluff Trace",Lookingglass,OR.,38754,159-979-1095
    const FIELDS = [
        'id',
        'first_name',
        'last_name',
        'address',
        'city',
        'state_province',
        'postcode',
        'phone_num'
    ];
}

// inserts or updates products from a CSV file
$csv_fn = __DIR__ . '/../sample_data/fake.csv';
if (!file_exists($csv_fn)) throw new RuntimeException(static::ERR_CSV);
$pdo = new PDO('mysql:dbname=test;host=localhost', 'user', 'password', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$num = 0;
$obj = new SplFileObject($csv_fn, 'r');
while ($row = $obj->fgetcsv()) {
    if (empty($row)) continue;
    $product = new Product($row);
    // assumes key is 1st column
    $key = trim($row[0]);
    // insert or update?
    if (!empty($product->select($pdo, $key))) {
        $num += (int) $product->update($pdo, $key);
    } else {
        $num += (int) $product->insert($pdo);
    }
}
echo "Processed : $num rows\n";
