<?php
// Thanks to Bart Monbaliu!

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
                    <label for="gender[]">gender:</label>
                    <input type="radio" name="gender[]" value="MALE"<?php echo (isset($sanitizedInputs['gender']) && in_array('MALE', $sanitizedInputs['gender'])) ? 'checked' : '' ?> />Male
                    <input type="radio" name="gender[]" value="FEMALE"<?php echo (isset($sanitizedInputs['gender']) && in_array('FEMALE', $sanitizedInputs['gender'])) ? 'checked' : '' ?> />Female
                </li>
                <li>
                    <label for="pets[]">pet(s):</label>
                    <input type="checkbox" name="pets[]" value="CAT"<?php echo (isset($sanitizedInputs['pets']) && in_array('CAT', $sanitizedInputs['pets'])) ? 'checked' : '' ?> />Cat
                    <input type="checkbox" name="pets[]" value="DOG"<?php echo (isset($sanitizedInputs['pets']) && in_array('DOG', $sanitizedInputs['pets'])) ? 'checked' : '' ?> />Dog
                    <input type="checkbox" name="pets[]" value="GOLDFISH"<?php echo (isset($sanitizedInputs['pets']) && in_array('GOLDFISH', $sanitizedInputs['pets'])) ? 'checked' : '' ?> />Goldfish
                </li>
                <li>
                    <label for="hobbies[]">hobbies:</label>
                    <select name="hobbies[]">
                        <option value="">---------</option>
                        <option value="MOVIES"<?php echo (isset($sanitizedInputs['hobbies']) && in_array('MOVIES', $sanitizedInputs['hobbies'])) ? 'selected' : '' ?>>Movies</option>
                        <option value="BASKETBALL"<?php echo (isset($sanitizedInputs['hobbies']) && in_array('BASKETBALL', $sanitizedInputs['hobbies'])) ? 'selected' : '' ?>>Play basketball</option>
                        <option value="RUNNING"<?php echo (isset($sanitizedInputs['hobbies']) && in_array('RUNNING', $sanitizedInputs['hobbies'])) ? 'selected' : '' ?>>Running</option>
                    </select>
                </li>
                <li>
                    <label for="address[line1]">Address Line 1:</label>
                    <input type="text" name="address[]" value="<?php echo $address[0] ?>" />
                </li>
                <li>
                    <label for="address[line2]">Address Line 2:</label>
                    <input type="text" name="address[]" value="<?php echo $address[1] ?>" />
                </li>
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
