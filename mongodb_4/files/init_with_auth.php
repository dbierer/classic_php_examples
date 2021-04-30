<?php
// Chapter 8 _From Web Form to MongoDB_
// this file returns config params
// use this file if you want to demo with security and transactions

// demo system:
// mongo shell connection string for this user:
// mongo  --ssl -sslPEMKeyFile /etc/ssl/client.pem --sslPEMKeyPassword "password" --sslCAFile /etc/ssl/ca.pem --host mongod -u "zed" -p "password" --authenticationDatabase "admin"

// return connection params
return [
    'uri' => [
        'host' => 'mongod',
        'database' => 'sweetscomplete',
        'username' => 'CN=zed,OU=mongodb,O=unlikelysource,L=Surin,ST=Surin,C=TH',
        'password' => 'password',
    ],
    'uriOpts' => [
        'ssl' => true,
        'replicaSet' => 'sweets_11',
        'authSource' => 'admin',
    ],
    'driverOpts' => [
        'ca_file' => '/etc/ssl/ca.pem',
        'pem_file' => '/etc/ssl/zed.pem',
        'pem_pwd' => 'password',
    ],
];
