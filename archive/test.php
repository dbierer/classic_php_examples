<?php
// Create database connection
$pdo = include './db/get_pdo.php';

// Open connection
try {
    // get list of product SKUs
    $stmt = $pdo->query('SELECT sku FROM products');
    $skus = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'sku');
    $max  = count($skus) - 1;
    
    // get list of customer IDs
    $stmt = $pdo->query('SELECT id FROM customers');
    $ids  = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id');

    // SQL prepare
    $sql = "UPDATE customers SET products_purchased = :d WHERE id = :i";
    $sth = $pdo->prepare($sql);

    foreach ($ids as $id) {
        // get how many products
        $num = random_int(1, 12);
        $prods = [];
        // build random array of products "purchased"
        for ($x = 0; $x < $num; $x++) {
            $prods[] = $skus[random_int(0, $max)];
        }
        $json = json_encode($prods);
        echo $json . PHP_EOL;
        $sth->execute(['d' => $json, 'i' => $id]);
    }

    $stmt = $pdo->query('SELECT * FROM customers');
    var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

