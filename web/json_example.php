<?php
// JSON example
$json = <<<EOT
{
    "users": {
        "firstName": "John",
        "lastName": "Smith",
        "isAlive": true,
        "age": 25,
        "address": {
            "street": "21 2nd Street",
            "city": "Toronto",
            "state_province": "Ontario",
            "postalCode": "MC3 0C1"
        },
        "phone": [
            "111-222-3333",
            "444-555-6666"
        ]
    }
}
EOT;
// Decode as a standard class object
$userObject = json_decode( $json );
var_dump( $userObject ) . PHP_EOL;
// Decode as an associated array
$userArray = json_decode( $json , true );
var_dump( $userArray );

/*
$data = ['users' => [
'firstName' => 'John',
'lastName' => 'Smith',
'isAlive' => true,
'age' => 25,
'address' => ['street' => '21 2nd Street','city' => 'Toronto','state_province'=>'Ontario','postalCode'=>'MC3 0C1'],
'phone' => ['111-222-3333','444-555-6666']
]];
echo json_encode($data, JSON_PRETTY_PRINT);
*/
