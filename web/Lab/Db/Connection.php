<?php
namespace Lab\Db;

use PDO;
class Connection
{
    protected $pdo;
    /**
     * Creates a PDO connection
     *
     * @throws PDOException if PDO instance fails
     */     
    public function __construct(array $config)
    {
        $dsn = 'mysql:dbname=' . $config['dbname'] . ';host=' . $config['host'];
        $this->pdo = new PDO($dsn, $config['username'], $config['password']);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getConnection()
    {
        return $this->pdo;
    }
}
        
