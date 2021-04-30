<?php
// this example demostrates the following SPL classes:
// SplSubject
// SplObserver
// SplStorageObject
// primitive REST request handler

spl_autoload_register(
    function ($class) {
        $fn = str_replace('\\', '/', $class);
        $fn = __DIR__ . '/' . $fn . '.php';
        require $fn;
    }
);
use Classes\RestSubject;
use Classes\LoggingObserver;
use Classes\AuthObserver;
use Classes\HandlerObserver;

$rest = new RestSubject();
$rest->attach(new LoggingObserver());
$rest->attach(new AuthObserver());
$rest->attach(new HandlerObserver());
$rest->notify();
