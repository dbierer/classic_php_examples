<?php
// see PDO_SQLSRV.md readme file first!

// Database params
$tcp  = '192.168.3.126';
$port = 1433;
$user = "test";
$password = "Password123";
$database = "test";

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
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $output = '<pre>';
        $output .= implode("\t", array_keys($row)) . PHP_EOL;
        $output .= implode("\t", $row) . PHP_EOL;
        while ($row = $sth->fetch(PDO::FETCH_NUM)) {
            $output .= implode("\t", $row) . PHP_EOL;
        }
    }
} catch (PDOException $e) {
    $output .= $e->getMessage();
}
$output .= '</pre>';
echo $output;
