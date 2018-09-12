<?php
// Create database connection

$mysql_host = 'localhost';
$mysql_database = 'zend';
$mysql_user = 'zend';
$mysql_password = 'password';

$lastName = 'W%';
$minZip   = '10000';
$maxZip   = '20000';

// Open connection
try {

    // Database connect -- use one of the two statements below
    // $dsn =   'mysql:host=' . $mysql_host . ';dbname=' . $mysql_database';
    $dsn =  'mysql:unix_socket=/var/run/mysqld/mysqld.sock;dbname=' . $mysql_database;
    $dbh = new PDO( $dsn, $mysql_user, $mysql_password);

    // Set error mode (see http://www.php.net/manual/en/pdo.error-handling.php)
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL prepare
    $sql = "SELECT * FROM `names` WHERE `last_name` LIKE ? AND (`zip` >= ? AND `zip` < ?)";
    $sth = $dbh->prepare($sql);

    // Execute
    $sth->execute([$lastName, $minZip, $maxZip]);
    var_dump($sth);

    // Fetch results
    echo '<table border=1>' . PHP_EOL;
    // Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
    while ($row = $sth->fetch(PDO::FETCH_LAZY)) {
        echo '<tr><td>' . var_export($row, TRUE) . '</td></tr>' . PHP_EOL;
    }
    echo '</table>' . PHP_EOL;

} catch (PDOException $e) {

    echo $e->getMessage();

} catch (Exception $e) {

    echo $e->getMessage();

}
