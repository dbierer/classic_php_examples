<?php
//This is a PHP (4/5) script example on how eurofxref-daily.xml can be parsed

// the file is updated daily between 2.15 p.m. and 3.00 p.m. CET
define('ECB_URL', 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');

class Rate
{
    public $code;
    public $rate;
    public function __construct($code, $rate)
    {
        $this->code = $code;
        $this->rate = $rate;
    }
}

function getEcbRates()
{
    //Read eurofxref-daily.xml file in memory
    $XMLContent= file(ECB_URL);

    // Parse output
    $rates = array();
    foreach ($XMLContent as $line) {
       if (preg_match("/currency='([[:alpha:]]+)'/", $line, $currencyCode)) {
           if (preg_match("/rate='([[:graph:]]+)'/", $line, $rate)) {
              //Output the value of 1 EUR for a currency code
              yield new Rate($currencyCode[1], $rate[1]);
           }
       }
    }
}

$output = '<table>' . PHP_EOL;
foreach (getEcbRates() as $rate) {
    $output .= "<tr><td>{$rate->code}</td><td>{$rate->rate}</td></tr>\n";
}
$output .= '</table>' . PHP_EOL;
echo $output;

