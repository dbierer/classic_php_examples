<?php
namespace App\Service;

use SplObjectStorage;
use Psr\Container\ContainerInterface;

class Manager implements ContainerInterface
{
    public $idx = 0; // ID of object
    public $services = [];
    public $container = NULL;
    public function __construct()
    {
        $this->container = new SplObjectStorage();
    }
    /**
     * Add a service
     *
     * @param object $service
     * @param string $alias
     * @return int $nextId
     */
    public function add(object $service, string $alias = '') : int
    {
        $key = (!empty($alias)) ? $alias : get_class($service);
        $this->container->attach($service, $alias);
        $this->services[$key] = $this->idx++;
        return $this->idx;
    }
    /**
     * Removes a service
     *
     * @param string $id Identifier of the entry to look for.
     * @return bool: TRUE if service removed; FALSE otherwise (e.g. service didn't exist)
     */
    public function remove(string $id) : bool
    {
        $ok = FALSE;
        $obj = $this->get($id);
        if (!empty($obj)) {
            $this->container->detach($obj);
            $ok = TRUE;
        }
        return $ok;
    }
    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundExceptionInterface  No entry was found for **this** identifier.
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get(string $id)
    {
        $id = trim($id);
        $obj = NULL;
        foreach ($this->container as $obj) {
            $class = get_class($obj);   // class
            $info  = $this->container->getInfo();   // alias (if any)
            if ($id === $class || $id === $info) break;
        }
        return $obj;
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
     * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id) : bool
    {
        return (bool) $this->get($id);
    }
}

