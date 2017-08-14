<?php 
interface ConvertableInterface
{
    public function getArray();
}
class Data implements ConvertableInterface
{
    protected $values;
    public function __construct($values)
    {
        $this->values = $values;
    }
    public function getArray()
    {
        if ($this->values instanceof ArrayObject) {
            return $this->values->getArrayCopy();
        } elseif (is_array($this->values)) {
            return $this->values;
        } else {
            return (array) $this->values;
        }
    }
}
class Special implements ConvertableInterface
{
    protected $values;
    public function __construct(array $values)
    {
        $this->values = $values;
    }
    public function getArray()
    {   
        return $this->values;
    }
}
class Test
{
    public function buildDays()
    {
        $days = array();
        $date = new DateTime('2017-10-1');
        for ($x = 0; $x < 7; $x++) {
            $date->add(new DateInterval('P1D'));
            $days[$date->format('d')] = $date->format('l');
        }
        return $days;
    }
    public function buildMonths()
    {
        $months = array();
        $date = new DateTime('2017-1-1');
        for ($x = 0; $x < 12; $x++) {
            $months[$date->format('m')] = $date->format('M');
            $date->add(new DateInterval('P1M'));
        }
        return $months;
    }
    public function makeSelect(ConvertableInterface $data)
    {
        $html = '<select name="days">';
        foreach ($data->getArray() as $key => $value) {
            $html .= '<option value="' . $key . '">' . $value . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}

$test    = new Test();
$special = new Special($test->buildDays());
$data    = new Data($test->buildMonths());

echo $test->makeSelect($special);
echo '<br>';
echo $test->makeSelect($data);

