<?php
// index.php
$error = [];
$username = $email = $password = '';

function validate_input($data) {
    return trim(strip_tags($data));
}

// process file upload
$path = realpath(__DIR__ . '/../data');
if (!empty($_FILES)) {
	$tmp = $_FILES['upload']['tmp_name'] ?? '';
	if (empty($tmp)) {
		$error['file'] = 'No temporary file';
	} elseif (!is_uploaded_file($tmp))  {
		$error['file'] = 'Not a valid uploaded file';
	} else {
		$error_code = $_FILES['upload']['error'] ?? 999;
		if ($error_code !== 0) {
			$error['file'] = 'File upload error';
		} else {
			$name  = $_FILES['upload']['name'] ?? 'temp.jpg';
			$final = $path . '/' . strip_tags(basename($name));
			move_uploaded_file($tmp, $final);
			$error['file'] = 'File uploaded successfully!';
		}
	}
}
// alternatively you can to this:
// if (!empty($_POST)) {

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $error['username'] = 'A name is required';
    } else {
        $username = validate_input($_POST["username"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
            $error['username'] = 'Only letters and white space allowed';
        }
    }

    if (empty($_POST["email"])) {
        $error['email'] = 'Email is required';
    } else {
        $email = validate_input($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'Invalid email format';
        }
    }

    if (empty($_POST["password"])) {
        $error['password'] = 'A password is required';
    } else {
        $password = validate_input($_POST["password"]);
        if (!filter_var($password, FILTER_VALIDATE_INT)) {
            $error['password'] = 'Only Integers are allowed';
        }
    }
}

include __DIR__ . '/template.php';
