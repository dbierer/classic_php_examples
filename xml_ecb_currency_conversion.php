<?php
//This is a PHP (4/5) script example on how eurofxref-daily.xml can be parsed 

//Read eurofxref-daily.xml file in memory 
$XMLContent= file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
//the file is updated daily between 2.15 p.m. and 3.00 p.m. CET

// Parse output
$rates = array();
foreach ($XMLContent as $line) {
   if (preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)) {
       if (preg_match("/rate='([[:graph:]]+)'/",$line,$rate)) {
          //Output the value of 1 EUR for a currency code 
          $rates[$currencyCode[1]] = $rate[1];
       }
   }
}
var_dump($rates);
?> 