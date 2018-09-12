<?php
// classic usage of list():
$fruits = ['apples', 'oranges', 'bananas'];
list($fruitOne, $fruitTwo, $fruitThree) = $fruits;
echo "My fruits include: " . $fruitTwo . ", " . $fruitThree . ", and " . $fruitOne . "\n";
/* Yields: "My fruits include: oranges, bananas, and apples"*/

// alternative to "list()" using symmetric array destructuring:
[$fruitOne, $fruitTwo, $fruitThree] = $fruits;
echo "My fruits include: " . $fruitTwo . ", " . $fruitThree . ", and " . $fruitOne . "\n";
/* Yields: "My fruits include: oranges, bananas, and apples"*/

