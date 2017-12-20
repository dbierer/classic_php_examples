<?php
class Test
{
    protected $id;
    protected $name;
    protected $amount;
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }
}

$test = (new Test())->setId(123)->setName('Joe')->setAmount(99.99);

var_dump($test);
