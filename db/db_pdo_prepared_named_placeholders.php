<?php
// Create database connection

$mysql_host = 'localhost';
$mysql_database = 'zend';
$mysql_user = 'zend';
$mysql_password = 'password';

$params = [
    'first' => 'A%',
    'order' => 'last_name ASC'
];

// Open connection
try {

    // Database connect -- use one of the two statements below
    // $dsn =   'mysql:host=' . $mysql_host . ';dbname=' . $mysql_database';
    $dsn =  'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=' . $mysql_database;
    $dbh = new PDO( $dsn, $mysql_user, $mysql_password);

    // Set error mode (see http://www.php.net/manual/en/pdo.error-handling.php)
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL prepare
    $sql = "SELECT `id`, `first_name`, `last_name` FROM `names` WHERE `first_name` LIKE :first ORDER BY :order LIMIT 20";
    $sth = $dbh->prepare($sql);

    // Execute
    $sth->execute($params);
    var_dump($sth);

    // Fetch results
    foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo implode(',', $row) . PHP_EOL;
    }

} catch (PDOException $e) {

    echo $e->getMessage();

} catch (Exception $e) {

    echo $e->getMessage();

}
