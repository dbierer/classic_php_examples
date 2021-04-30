<?php
// Chapter 8 _From Web Form to MongoDB_
// this file is the initial point of entry for the website

// autoloading
include __DIR__ . '/../vendor/autoload.php';
use Application\ {Base, Main};

// get start/end dates + limit from URL (if any)
$start_date = 'now';
$end_date   = '';
$limit      = Base::DEFAULT_LIMIT;

// init vars
$ajax = Main::buildUrl($start_date, $end_date, $limit);
include __DIR__ . '/index.phtml';
