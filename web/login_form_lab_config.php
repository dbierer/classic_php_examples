<?php
$config = [
    'form' => [
        'form' => [
            'login' => [
                'method' => 'post',
                'id' => 'login'
            ],
        ],
        'elements' => [
            'username' => [
                'label' => 'Email Address: ',
                'type' => 'email',
                'id' => 'username',
                'title' => 'Enter your email address to login',
            ],
            'password' => [
                'label' => 'Password: ',
                'type' => 'password',
                'id' => 'password',
                'title' => 'Enter your password',
            ],
            'login' => [
                'type' => 'submit',
                'name' => 'login',
                'value' => 'Login'
            ],
            'logout' => [
                'type' => 'submit',
                'name' => 'logout',
                'value' => 'Logout'
            ]
        ]
    ],
    'validator' => [
        'elements' => [
            // template
            'username' => [
                ['trim' => []],
                ['stripTags' => []],
                ['email' => []],
            ],
            // NOTE: in production you will most likely NOT validate a password entry!
            //       ... has the potential to give away too much information to an attacker
            'password' => [
                ['trim' => []],
                ['strlen' => ['min' => 1, 'max' => 8]],
                ['regex' => ['pattern' => '/[A-Za-z!0-9]/']],
            ],
        ]
    ],
    'database' => [
        'dbname' => 'zend',
        'host' => 'localhost',
        'username' => 'test',
        'password' => 'password',
    ],
];

return $config;
