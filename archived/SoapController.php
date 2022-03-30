<?php
namespace controllers;
use models;
class SoapController {
	public function indexAction()
	{
		$soapServer = new SoapServer('../Soap.wsdl');
		$soapServer->setClass('Soap');
		$soapServer->handle();
	}
}
?>
