<?php
namespace Application;

use Exception;
use MongoDB\Client as MongoClient;
/**
 * Creates instance of MongoDB\Client
 * Only accepts 1 host
 */
class Connection
{

    const ERROR_HOST = 'ERROR: host must be specified';
    const ERROR_OPTS = 'ERROR: options must be an array even if only one';
    const ERROR_CONFIG_URI = 'ERROR: must include a key "uri" in config with MongoDB connection info';

    protected $mongoClient;
    protected $manager;     // MongoDB\Driver\Manager
    public function __construct($config)
    {
        if (!isset($config['uri'])) {
            throw new Exception(self::ERROR_CONFIG_URI);
        }
        $uriOpts = $config['uriOpts'] ?? [];
        $driverOpts = $config['driverOpts'] ?? [];
        $uri = $this->buildUri($config);
        $this->mongoClient = new MongoClient($uri, $uriOpts, $driverOpts);
        $this->manager = $this->mongoClient->getManager();
    }
    public function getClient()
    {
        return $this->mongoClient;
    }
    public function getManager()
    {
        return $this->manager;
    }
    public function getSession()
    {
        return $this->manager->startSession();
    }
    // see: https://docs.mongodb.com/manual/reference/connection-string/#standard-connection-string-format
    public function buildUri($config)
    {
        $uri = 'mongodb://';
        if (isset($config['uri']['username']) && isset($config['uri']['password']))
            $uri .= $config['uri']['username'] . ':' . $config['uri']['password'] . '@';
        if (!isset($config['uri']['host']))
            throw new Exception(self::ERROR_HOST);
        $uri .= $config['uri']['host'];
        $uri .= (isset($config['uri']['port'])) ? ':' . $config['uri']['port'] : '';
        $uri .= (isset($config['uri']['database'])) ? '/' . $config['uri']['database'] : '';
        if (isset($config['uriOpts'])) {
            if (!is_array($config['uriOpts']))
                throw new Exception(self::ERROR_OPTS);
            $uri .= '?';
            foreach ($config['uriOpts'] as $key => $value)
                $uri .= $key . '=' . $value . '&';
            // trim trailing '&'
            $uri = substr($uri, 0, -1);
        }
        return $uri;
    }
}
