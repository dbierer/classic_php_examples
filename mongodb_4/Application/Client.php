<?php
namespace Application;

use Exception;
use MongoDB\Client as MongoClient;
/**
 * Creates instance of MongoDB\Client
 * Only accepts 1 host
 */
class Client
{

    const ERROR_HOST = 'ERROR: host must be specified';
    const ERROR_OPTS = 'ERROR: options must be an array even if only one';
    protected $uri;
    protected $mongoClient;
    public function __construct($config)
    {
        $this->uri = $this->buildUri($config);
        $this->mongoClient = new MongoClient($this->uri);
    }
    public function getClient()
    {
        return $this->mongoClient;
    }
    // see: https://docs.mongodb.com/manual/reference/connection-string/#standard-connection-string-format
    public function buildUri($config)
    {
        $uri = 'mongodb://';
        if (isset($config['username']) && isset($config['password'])) {
            $uri .= $config['username'] . ':' . $config['password'] . '@';
        }
        if (!isset($config['host'])) {
            throw new Exception(self::ERROR_HOST);
        }
        $uri .= $config['host'];
        $uri .= (isset($config['port'])) ? ':' . $config['port'] : '';
        $uri .= (isset($config['database'])) ? '/' . $config['database'] : '';
        if (isset($config['options'])) {
            if (!is_array($config['options'])) {
                throw new Exception(self::ERROR_OPTS);
            }
            $uri .= '?';
            foreach ($config['options'] as $key => $value) {
                $uri .= $key . '=' . $value . '&';
            }
            // trim trailing '&'
            $uri = substr($uri, 0, -1);
        }
        return $uri;
    }
}
