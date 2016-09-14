<?php
$soap = new SoapClient("http://webservice.webserviceshare.com/currencyconverter/rates.asmx?WSDL", array('trace' => TRUE));
try {
//	$test = $soap->GetConvertedAmount('Doug Bierer@b657c48b-e43b-45c3-9630-48596c902cf5',"USD","GBP",100);
	$test = $soap->GetConvertedAmount('b657c48b-e43b-45c3-9630-48596c902cf5',"USD","GBP",100);
} catch (SoapFault $s) {
	echo $s->getMessage();
}
var_dump($test);
?>

