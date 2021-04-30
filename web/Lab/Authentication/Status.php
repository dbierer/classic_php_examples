<?php
namespace Lab\Authentication;

class Status
{
    const SESSION_KEY = 'authentication-status';
    const DEFAULT_ITEM = 'Unknown';
    public function __construct()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    public function storeStatus($info)
    {
        $_SESSION[self::SESSION_KEY] = $info;
    }
    public function getStatus()
    {
        return $_SESSION[self::SESSION_KEY] ?? NULL;
    }
    public function clearStatus()
    {
        $_SESSION[self::SESSION_KEY] = NULL;
        session_destroy();
        session_unset();
    }
    public function __get($key)
    {
        return $_SESSION[self::SESSION_KEY][$key] ?? self::DEFAULT_ITEM;
    }
}
