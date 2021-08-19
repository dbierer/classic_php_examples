<?php
// /This is a PHP (4/5) script example on how eurofxref-daily.xml can be parsed 

//Read eurofxref-daily.xml file in memory 
$XMLContent= file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
//the file is updated daily between 2.15 p.m. and 3.00 p.m. CET

foreach ($XMLContent as $line) {
        if (ereg("currency='([[:alpha:]]+)'",$line,$currencyCode)) {
            if (ereg("rate='([[:graph:]]+)'",$line,$rate)) {
                    //Output the value of 1 EUR for a currency code 
                    echo '1 &euro; = '.$rate[1].' '.$currencyCode[1].'<br />';
                    //--------------------------------------------------
                    // Here you can add your code for inserting
                    // $rate[1] and $currencyCode[1] into your database
                    //--------------------------------------------------
            }
        }
}
?>
