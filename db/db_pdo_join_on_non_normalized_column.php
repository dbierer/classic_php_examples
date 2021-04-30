<?php
// here is "customers" where "products_purchased" == JSON array of product SKUs
/*
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `products_purchased` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
*/
// here is "products"
/*
CREATE TABLE `products` (
  `sku` int(8) NOT NULL COMMENT 'SKU number',
  `pid` char(32) NOT NULL COMMENT 'Product ID',
  `unit` varchar(255) NOT NULL COMMENT 'How sold',
  `cost` decimal(10,2) NOT NULL,
  `qty_oh` int(6) NOT NULL COMMENT 'Quantity on hand',
  `description` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`sku`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
*/

// Create database connection
$pdo = include 'get_pdo.php';

// Open connection
try {
    
    // get list of customers + products based on non-normalized column "products_purchased"
    $stmt = $pdo->query("SELECT * FROM products AS p JOIN customers AS c ON c.products_purchased LIKE CONCAT('%', p.sku, '%')");
    var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

