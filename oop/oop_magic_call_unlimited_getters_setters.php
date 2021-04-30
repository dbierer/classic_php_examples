<?php
class Test
{
    protected $values;
    public function __call($name, $params)
    {
        if (strpos($name, 'set') === 0) {
            $this->values[substr($name, 3)] = $params[0];
        } elseif (strpos($name, 'get') === 0) {
            $key = substr($name, 3);
            return (isset($this->values[$key])) ? $this->values[$key] : NULL;
        }
    }
}

$test = new Test();
$test->setStatus('caveman');
$test->setFirstName('Fred');
$test->setLastName('Flintstone');
echo $test->getFirstName() . ' ' . $test->getLastName() . ' is a ' . $test->getStatus();
echo PHP_EOL . '<br>';

