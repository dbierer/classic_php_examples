<?php
// see PDO_SQLSRV.md readme file first!

// Create database connection
$host = 'asus.windoze';
$tcp  = '192.168.3.126';
$port = 1433;
$user = "test";
$database = "test";
$password = "Password123";
// Open connection
try {
    // Database connect -- use one of the two statements below
    $dsn =  'sqlsrv:Server=tcp:' . $tcp . ',' . $port . ';Database=' . $database;
    $dbh = new PDO( $dsn, $user, $password, array());
    // SQL prepare
    $sql = "SELECT * FROM prospects";
    $sth = $dbh->prepare($sql);
    // Execute
    $sth->execute();
    // Fetch results
    // Fetch options: PDO::FETCH_NUM | PDO::FETCH_ASSOC | PDO::FETCH_OBJ etc.
    while ($row = $sth->fetch(PDO::FETCH_LAZY)) {
        echo var_export($row, TRUE);
        //echo $row->pid;  // for object
        //echo $row['pid']; // for array
    }
    echo PHP_EOL;
} catch (PDOException $e) {
    echo $e->getMessage();
}
