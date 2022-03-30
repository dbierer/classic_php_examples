<?php
// See `oop_enum.php` to see how to do this using Enums
class Signup
{
    const MALE   = 'M';
    const FEMALE = 'F';
    const OTHER  = 'X';
    const GENDER = [self::MALE, self::FEMALE, self::OTHER];
    const ERR_GENDER = 'ERROR: gender must be one of M|F|X';
    public function __construct(
        public string $username,
        public string $password,
        public string $dateOfBirth,
        public string $gender)
    {
        if (!in_array($gender, self::GENDER))
            throw new Exception(self::ERR_GENDER);
    }
}

$fred = new Signup('fred', 'pass', '1970-01-01', Signup::MALE);
var_dump($fred);

// Fatal Error
$wilma = new Signup('wilma', 'pass', '1970-01-01', 'FEMALE');
var_dump($wilma);

// Output:
/*
object(Signup)#1 (4) {
  ["username"]=>
  string(4) "fred"
  ["password"]=>
  string(4) "pass"
  ["dateOfBirth"]=>
  string(10) "1970-01-01"
  ["gender"]=>
  string(1) "M"
}
PHP Fatal error:  Uncaught Exception: ERROR: gender must be one of M|F|X in oop_before_enum.php:17
 */
