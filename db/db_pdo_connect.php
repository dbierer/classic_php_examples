<?php
// Create database connection
$pdo = include 'get_pdo.php';
// Open connection
try {
    // SQL prepare
    $sql = "SELECT * FROM products";
    $sth = $pdo->prepare($sql);
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

?>
