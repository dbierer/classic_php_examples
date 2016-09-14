<?php
require_once 'Zend/Mail.php';
require_once 'Zend/Mail/Transport/Smtp.php';

$host = 'smtp.gmail.com';
$email = 'doug@unlikelysource.com';
$from = '2008keytech@gmail.com';
$message = '<b>This</b> is a <i>test</i>.';
$smtp = new Zend_Mail_Transport_Smtp($host);

$mail = new Zend_Mail;
$mail->addTo($email, 'Doug');
$mail->setFrom($from, 'Tech');
$mail->setSubject('This is a Test');
$mail->setBodyHtml($message);
$mail->send($smtp);
