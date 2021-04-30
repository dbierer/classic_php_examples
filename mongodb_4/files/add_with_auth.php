<?php
// Chapter 8 _From Web Form to MongoDB_

// autoloading
include __DIR__ . '/../vendor/autoload.php';
use Application\ {Base,Add};

// init vars
$name    = '';
$sku     = '';
$qty     = 1;
$product = '';
$params  = include __DIR__ . '/../Application/init.php';
$message = '<h1 style="color:blue;">Please enter the customer name, product title, and quantity.</h1>';

if ($_POST) {
    // check for cancel
    if (isset($_POST['cancel'])) {
        header('Location: /');
        exit;
    }
    // otherwise, process post data
    $message = '<h1 style="color:red;">You must enter a valid customer and product before proceeding</h1>';
    if (isset($_POST['name']))
        $name = strip_tags($_POST['name']);

    if (isset($_POST['product'])) {
        $product = strip_tags($_POST['product']);
        preg_match('/.*\[(.*?)\]/', $product, $matches);
        if (isset($matches[1])) {
            $sku = strip_tags($matches[1]);
        }
    }
    if ($name && $sku) {

        // grab quantity
        $quantity = (isset($_POST['quantity'])) ? (int) $_POST['quantity'] : 1;

        // create connection
        $service = new Add($params);

        // lookup customer
        $customerDoc = $service->findCustomerByName($name);
        $message = '<pre>' . var_export($customerDoc, TRUE) . '</pre>';

        // lookup product
        $productDoc = $service->findProductBySku($sku);
        $message .= '<pre>' . var_export($productDoc, TRUE) . '</pre>';

        //******************************************************************//
        // Use this block if you want to test transaction support
        // Must be running on a member of a replica set
        if ($service->savePurchaseWithSession($customerDoc, $productDoc, $quantity)) {
            header('Location: /');
            exit;
        } else {
            $message = '<h1 style="color:red;">Unable to process purchase</h1>';
        }
    }
}
include __DIR__ . '/add.phtml';
