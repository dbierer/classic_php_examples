<?php
// Shows widening of type hints
class TestParent
{
    public function add(int $a, int $b)
    {
        return $a + $b;
    }
    public function sum(array $arr)
    {
        return array_sum($arr);
    }
}

class TestChild extends TestParent
{
    // NOTE: cannot just change type hint "int" to "float" because it's seen as a distinct data type in PHP
    public function add(int|float $a, int|float $b)
    {
        return $a + $b;
    }
    // NOTE: to accept "iterable" we had to remove "array_sum()" as it's hard-coded to only accept type "array"
    public function sum(iterable $arr)
    {
        $total = 0;
        foreach ($arr as $num) {
            $total += $num;
        }
        return $total;
    }
}

$child = new TestChild();
echo $child->add(2,2);
echo PHP_EOL;
echo $child->add(4.44,5.55);
echo PHP_EOL;
echo $child->sum([1,2,3,4,5]);
echo PHP_EOL;
echo $child->sum(new ArrayIterator([1,2,3,4,5]));
echo PHP_EOL;
