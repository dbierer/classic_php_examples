<?php
namespace Classes;
class TestPublic
{
    public $name;
    public $amount;
    public function __construct($name, $amount)
    {
        $this->name = $name;
        $this->amount = $amount;
    }
    /**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param field_type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return the $amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param field_type $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

}
