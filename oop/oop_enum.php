<?php
// NOTE: only works in PHP 8.1 and above
enum Gender
{
    case MALE;
    case FEMALE;
    case OTHER;
}

class Signup
{
    public function __construct(
        public string $username,
        public string $password,
        public string $dateOfBirth,
        public Gender $gender)
    {}
}

$fred = new Signup('fred', 'pass', '1970-01-01', Gender::MALE);
var_dump($fred);

/*
object(Signup)#1 (4) {
  ["username"]=>
  string(3) "tom"
  ["password"]=>
  string(4) "pass"
  ["dateOfBirth"]=>
  string(10) "1970-01-01"
  ["gender"]=>
  enum(Gender::MALE)
}
*/

// Fatal Error
$wilma = new Signup('wilma', 'pass', '1970-01-01', 'FEMALE');
var_dump($wilma);
