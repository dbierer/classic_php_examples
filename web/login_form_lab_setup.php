<?php
// add to customers table:
//   `email` varchar(254) DEFAULT NULL,
//   `password` varchar(254) DEFAULT NULL,

require __DIR__ . '/Lab/AutoLoader/Loader.php';
$autoLoader = new \Lab\AutoLoader\Loader(__DIR__);

use Lab\Db\ { Connection, CustomerTable };

$config = include __DIR__ . '/login_form_lab_config.php';
$table = new CustomerTable(new Connection($config['database']));
$fake1 = ['national','northwest','consolidated','southern'];
$fake2 = ['telco','comm','media','tech'];
$fake3 = ['com','net'];

foreach ($table->findAll() as $row) {
    $email = strtolower(substr($row['firstname'], 0, 1) . $row['lastname']) 
           . '@'
           . $fake1[rand(0,3)] . $fake2[rand(0,3)] . '.' . $fake3[rand(0,1)];
    $password = password_hash('password', PASSWORD_BCRYPT);
    echo $email . ':';
    echo $password . ':';
    echo $table->updateById($row['id'], ['email' => $email, 'password' => $password]);
    echo PHP_EOL;
}
