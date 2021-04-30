<?php
class Test
{
    public function __invoke($a, $op, $b)
    {
        switch ($op) {
            case '+' :
                $result = $a + $b;
                break;
            case '-' :
                $result = $a - $b;
                break;
            case '*' :
                $result = $a * $b;
                break;
            case '/' :
                $result = ($b) ? $a / $b : 0;
                break;
            default :
                $result = 'Unknown';
        }
        return $result;
    }
    public function __toString()
    {
        return __CLASS__;
    }
}

$test = new Test();
echo 'The sum of 5 and 6 is '. $test(5, '+', 6);
echo '<br>'. PHP_EOL;
echo 'The difference between 5 and 6 is '. $test(5, '-', 6);
echo '<br>'. PHP_EOL;
echo 'The result of 5 times 6 is '. $test(5, '*', 6);
echo '<br>'. PHP_EOL;
echo 'The division of 5 and 6 is '. $test(5, '/', 6);
echo '<br>'. PHP_EOL;
echo 'We are trying to use ' 
     . $test 
     . ' as if it were a string.'
     . PHP_EOL;


