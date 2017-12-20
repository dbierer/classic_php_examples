<?php

// desired output: convert these to camelCase
// first_name => firstName
// last_name => lastName
// street_address => streetAddress
// city_state_postcode => cityStatePostCode

$test = ['first_name', 'last_name', 'street_address', 'city_state_postCode'];
$pattern = '/_[a-z]/';
$callback = function ($match) { return strtoupper(substr($match[0], 1, 1)); };

// using preg_replace_callback()
foreach ($test as $key => $value) {
    $test1[$key] = preg_replace_callback($pattern, $callback, $value);
}
echo "\n-----------------------------------\n";
echo "Using preg_replace_callback()\n";
echo "-----------------------------------\n";
var_dump($test1);

// using preg_replace_callback_array()
$test2 = preg_replace_callback_array(
    [ $pattern => $callback ],
    $test);
echo "\n-----------------------------------\n";
echo "Using preg_replace_callback_array()\n";
echo "-----------------------------------\n";
var_dump($test2);


