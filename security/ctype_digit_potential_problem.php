<?php
// Best Practice: only supply data type "string" as an argument to ctype_digit()
// See: https://www.php.net/ctype_digit

$_POST = [
    'id' => '1111',
    'age' => '49',
    'gender' => 'M',
    'amount' => '99.99',
    'life_universe_and_everything' => '42'
];

// output as it stands
$ptn = "%30s : %s\n";
printf($ptn, 'Form Field', 'Only Digits');
foreach ($_POST as $key => $value)
    printf($ptn, $key, (ctype_digit($value) ? 'Y' : 'N'));

// output:
/*
Form Field : Only Digits
                            id : Y
                           age : Y
                        gender : N
                        amount : N
  life_universe_and_everything : Y
 */

// now let's apply sanitization
$id = $_POST['id'] ?? 0;
$age = $_POST['age'] ?? 0;
$gender = $_POST['gender'] ?? '';
$amount = $_POST['amount'] ?? 0.00;
$life_etc = $_POST['life_universe_and_everything'] ?? 0;

$_POST['id'] = (int) $id;
$_POST['age'] = (int) $age;
$_POST['gender'] = (in_array($gender, ['M','F','X'])) ? $gender : 'X';
$_POST['amount'] = (float) $amount;
$_POST['life_universe_and_everything'] = (int) $life_etc;

printf($ptn, 'Form Field', 'Only Digits');
foreach ($_POST as $key => $value)
    printf($ptn, $key, (ctype_digit($value) ? 'Y' : 'N'));

// output:
/*
                    Form Field : Only Digits
                            id : Y
                           age : Y
                        gender : N
                        amount : N
  life_universe_and_everything : N

 */

// if a numeric argument is supplied, ctype_digit() converts it to an ASCII character if it's between -128 and 255
// and then checks to see if the ASCII character is within range of "0-9"

