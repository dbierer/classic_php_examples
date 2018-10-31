<?php

require __DIR__ . '/vendor/autoload.php';

use Application\Client;

$params = [
    'host' => '127.0.0.1',
    'database' => 'sweetscomplete'
];
$client = new Client($params);

var_dump($client);
