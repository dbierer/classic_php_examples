<?php
// Code challenge
/*
 * 1. Insert the letter "M" into a numeric array that consists of the letters of the alphabet
 * 2. Do no use any of the "sort()" functions 
 * 3. The final indexing should be 1 to 26
 * 4. You are encouraged to experiment with SplHeap as part of your solution
 */

// display function
function display(array $arr)
{
    foreach(array_keys($arr) as $x) printf("%3d", $x);
    echo PHP_EOL;
    foreach(array_values($arr) as $x) printf("%3s", $x);
    echo PHP_EOL;
}

// build the initial array:
$arr   = [];
$alpha = 'ABCDEFGHIJKLNOPQRSTUVWXYZ';
for ($x = 0; $x < strlen($alpha); $x++) {
    $arr[$x + 1] = $alpha[$x];
}
display($arr);

// initial output:
/*
  1  2  3  4  5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25
  A  B  C  D  E  F  G  H  I  J  K  L  N  O  P  Q  R  S  T  U  V  W  X  Y  Z
*/

// YOUR CODE GOES HERE

// expected output:
/*
  1  2  3  4  5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26
  A  B  C  D  E  F  G  H  I  J  K  L  M  N  O  P  Q  R  S  T  U  V  W  X  Y  Z
*/

