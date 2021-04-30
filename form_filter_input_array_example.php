<?php
ob_start();
session_start();
if (isset($_SESSION['token']) && isset($_POST['token']) && $_POST['token'] == $_SESSION['token']) {
    // Token is valid, continue processing form data
    phpinfo(INFO_VARIABLES);
//    echo $_SESSION['token'] . ' = ' . $_POST['token'];
} else {
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['token'] = $token;
}
$args = [
    'firstname' => FILTER_SANITIZE_ENCODED,
    'lastname' => FILTER_SANITIZE_ENCODED,
    'gender' => [
        'filter' => FILTER_SANITIZE_STRING,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'pets' => [
        'filter' => FILTER_SANITIZE_STRING,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'hobbies' => [
        'filter' => FILTER_SANITIZE_STRING,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'address' => [
        'filter' => FILTER_SANITIZE_STRING,
        'flags' => FILTER_REQUIRE_ARRAY
    ]
//    line1
//    line2
//    city_state_postal_code
];
//    city_state_postal_code
$sanitizedInputs = filter_input_array(INPUT_POST, $args);
list(
    $firstname,
    $lastname,
    $gender,
    $pets,
    $hobbies,
    $address
) = [
    $sanitizedInputs['firstname'],
    $sanitizedInputs['lastname'],
    $sanitizedInputs['gender'],
    $sanitizedInputs['pets'],
    $sanitizedInputs['hobbies'],
    $sanitizedInputs['address']
];
$argsGets = [
    'testget1' => FILTER_SANITIZE_STRING,
    'testget2' => FILTER_SANITIZE_STRING
];
$sanitizedGets = filter_input_array(INPUT_GET, $argsGets)
//var_dump($sanitizedInputs);
//var_dump($sanitizedGets);
?>        
<!DOCTYPE html>
<head>
<title></title>
</head>
<body>
<fieldset>
<legend>GET variables</legend>
<?php
if(isset($sanitizedGets) && is_array($sanitizedGets)){
	foreach($sanitizedGets as $key => $value){
		echo $key .': '. $value .'<br />';
	}
}
?>
    </fieldset>
    <form method="POST" action="<?php echo htmlentities('?testget1=&testget2=abc') ?>" name="testform" id="testform">
        <fieldset>
            <legend>POST variables</legend>
            <ol>
                <li>
                    <label for="firstname">first name:</label>
                    <input type="text" name="firstname" value="<?php echo $firstname ?>" autofocus="on" />
                </li>
                <li>
                    <label for="lastname">last name:</label>
                    <input type="text" name="lastname" value="<?php echo $lastname ?>" />
                </li>
                <li>
                <li>
                    <label for="address[line3]">Address Line 3:</label>
                    <input type="text" name="address[]" value="<?php echo $address[2] ?>" />
                </li>
                <li>
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
                    <input type="submit" value="go" />
                </li>
            </ol>
        </fieldset>
    </form>
</body>
</html>
