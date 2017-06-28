<?php
/*
 * All passwords == 'password'
 * Valid email logins to test:
 * 
 * gstevenson@nationaltech.net
 * jlevitz@northwestcomm.com
 * schu@consolidatedtelco.com
 * twhite@nationalmedia.net
 * mwhitney@southerntech.com
 * 
 */
function loggedInMessage($status, $message)
{
    $message[] = 'Logged In As: ' . $status->email;
    $message[] = 'Last Login: ' . $status->lastLogin;
    return $message;
}

require __DIR__ . '/Lab/AutoLoader/Loader.php';
$autoLoader = new \Lab\AutoLoader\Loader(__DIR__);

use Lab\Db\ { Connection, CustomerTable };
use Lab\Login\ { FormGen, FormValidator };
use Lab\Authentication\Status;

$message = [];
$config = include __DIR__ . '/login_form_lab_config.php';

// setup form object
$form = new FormGen($config['form']);

// check for post
$status = new Status();
if (isset($_POST['logout'])) {
    $status->clearStatus();
} elseif (isset($_POST['login'])) {

    if ($status->getStatus()) {
        $message = loggedInMessage($status, $message);
    } else {
        $validator = new FormValidator($config['validator']);
        if ($validator->validate($_POST, $form)) {
            $message[] = 'Form is Valid';
            // do database lookup
            $table = new CustomerTable(new Connection($config['database']));
            $info = $table->findCustomerByEmail($form->getValue('username'));
            if ($info) {
                if (password_verify($form->getValue('password'), $info['password'])) {
                    $info['lastLogin'] = date('l, d M Y H:i:s');
                    $status->storeStatus($info);
                    $message = loggedInMessage($status, $message);
                } else {
                    $message[] = 'Unable to process login at this time.  Code: ' . __LINE__;
                }
            } else {
                $message[] = 'Unable to process login at this time.  Code: ' . __LINE__;
            }
        } else {
            $form->setErrors($validator->getErrors());
            $message[] = 'Form is NOT Valid.  Code: ' . __LINE__;
        }
    }
}
if ($message) {
    echo '<h1>Message(s)</h1><ul><li>' . implode('</li><li>', $message) . '</li></ul>';
} else {
    echo '<hr>Enter your login name (1st letter of your first name, and entire last name)<hr>';
}
echo $form->theWholeForm();

