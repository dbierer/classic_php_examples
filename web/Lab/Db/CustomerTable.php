<?php
namespace Lab\Db;

use PDO;
/**
 * Process operations on "customers" table
 * 
 * @throws PDOException if any of the operations fail
 */
class CustomerTable
{
    const TABLE = 'customers';
    protected $pdo;
    public function __construct(Connection $conn)
    {
        $this->pdo = $conn->getConnection();
    }
    /**
     * @return PDOStatement
     */
    public function findAll()
    {
        $sql = 'SELECT * FROM ' . self::TABLE;
        $this->logSql($sql);
        return $this->pdo->query($sql);
    }
    public function findCustomerByEmail($email)
    {
        $sql = 'SELECT * FROM ' . self::TABLE . ' WHERE email = ?';
        $this->logSql($sql);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateById($id, $data)
    {
        $sql = 'UPDATE ' . self::TABLE . ' SET ';
        foreach ($data as $key => $value) {
            // create named placeholders
            $sql .= $key . '= :' . $key . ',';
        }
        // remove trailing comma
        $sql = substr($sql, 0, -1);
        $sql .= ' WHERE id = :id';
        $this->logSql($sql);
        $stmt = $this->pdo->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }
    public function save($data)
    {
        $sql = 'INSERT INTO ' . self::TABLE . ' ( ';
        foreach ($data as $key => $value) {
            $sql .= $key . ',';
        }
        // remove trailing comma
        $sql = substr($sql, 0, -1);
        $sql .= ' ) VALUES ( ';
        foreach ($data as $key => $value) {
            // create named placeholders
            $sql .= ':' . $key . ',';
        }
        // remove trailing comma
        $sql = substr($sql, 0, -1);
        $sql .= ' )';
        $this->logSql($sql);
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
    protected function logSql($sql)
    {
        error_log(date('Y-m-d H:i:s') . ':' . __METHOD__ . ':' . $sql);
    }
}
        
