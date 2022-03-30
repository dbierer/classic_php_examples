<?php
// See: https://www.php.net/manual/en/language.enumerations.overview.php
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
  enum(Gender::MALE)
}
PHP Fatal error:  Uncaught TypeError: Signup::__construct(): Argument #4 ($gender) must be of type Gender,
string given, called in oop_enum.php on line 37 and defined in oop_enum.php:12
 */
