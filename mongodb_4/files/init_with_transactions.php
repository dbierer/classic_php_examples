<?php
// Chapter 8 _From Web Form to MongoDB_
// this file returns config params
// use this file if you want to demo with no security but with transactions

// return connection params
return [
    'uri' => [
        // change the IP address to fit your server
        'host' => '192.168.2.107',
        'database' => 'sweetscomplete',
        'port' => 27017,
    ],
    'uriOpts' => [
        'replicaSet' => 'sweets_11',
    ],
];
