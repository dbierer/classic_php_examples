<?php
namespace Application;

/**
 * Serves as base class for Main, Lookup and Add
 */
class Base
{

    const DATE_FORMAT = 'Y-m-d';
    const DEFAULT_URL = '/json.php';
    const DEFAULT_LIMIT = 100;
    const DEFAULT_END_DATE = 'P99Y';

    protected $connection;
    protected $products;
    protected $purchases;
    protected $customers;

    public function __construct($config)
    {
        $this->connection = new Connection($config);
        $client = $this->connection->getClient();
        $this->products = $client->sweetscomplete->products;
        $this->purchases = $client->sweetscomplete->purchases;
        $this->customers = $client->sweetscomplete->customers;
    }
    /**
     * Gives access to Application\Connection
     * which in turn gives access to the client, manager and session
     *
     * @return Application\Connection $connection
     */
    public function getConnection()
    {
        return $this->connection;
    }
}
