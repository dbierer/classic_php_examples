<?php
// run this in case using php 5.x
date_default_timezone_set('UTC');
// generates memorable passwords
$passwd  = '';
$passes  = 3;	// number passes
$date = new DateTime();
// random special char
$source['special'] = function () {
	$special = '~!@#$%^&*()_+=-`[]\{}|;\':",./<>?';
	return $special[rand(0, strlen($special)-1)];
};
// random month
$source['month'] = function ($date) { 
	$month = rand(1,12); 
	$date->setDate(2020, $month, 1); 
	return $date->format('M'); 
};
// random day
$source['day'] = function ($date) { 
	$day = rand(1,7); 
	$date->setDate(2020, 1, $day); 
	return $date->format('D'); 
};
// 3 random alpha chars
$source['alpha'] = function () {
	$alpha = range('A','z');
	$chars = '';
	for ($x = 0; $x < 3; $x++) 
		$chars .= $alpha[array_rand($alpha)];
	return $chars;
};
// random number between 000 and 999
$source['num'] = function () {
	return sprintf('%03d', rand(0, 999));
};
$rand = rand(1,2);
if ($rand % 2 === 0) {
	$passwd .= $source['month']($date);
	$passwd .= $source['special']();
	$passwd .= $source['day']($date);
} else {
	$passwd .= $source['day']($date);
	$passwd .= $source['special']();
	$passwd .= $source['month']($date);
}
$passwd .= $source['special']();
$rand = rand(1,2);
if ($rand % 2 === 0) {
	$passwd .= $source['alpha']($date);
	$passwd .= $source['num']($date);
} else {
	$passwd .= $source['num']($date);
	$passwd .= $source['alpha']($date);
}
echo $passwd;
