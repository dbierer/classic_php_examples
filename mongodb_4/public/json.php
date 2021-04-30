<?php
// Chapter 8 _From Web Form to MongoDB_
// this file is the initial point of entry for the website

// autoloading
include __DIR__ . '/../vendor/autoload.php';

use Application\ {Base,Lookup,Main};

// create connection
$params  = include __DIR__ . '/../Application/init.php';
$service = new Lookup($params);

// search term (if any)
$term = (isset($_GET['term'])) ? strip_tags($_GET['term']) : '';

// produce results
$output = [];
try {
    if (isset($_GET['cust_name'])) {
        $output = $service->getListOfCustomers($term);
    } elseif (isset($_GET['prod_title'])) {
        $output = $service->getListOfProducts($term);
    } else {
        // get start/end dates + limit from URL (if any)
        $start_date = 'now';
        $end_date   = '';
        $limit      = Base::DEFAULT_LIMIT;
        Main::getUrlParams($start_date, $end_date, $limit);
        $output = ['data' => $service->getListOfPurchasesByDate($start_date, $end_date, $limit)];
    }
} catch (Throwable $e) {
    error_log(__METHOD__ . ':' . $e->getMessage());
    $output = 'ERROR: look at the error log for more information';
}
echo json_encode($output);
