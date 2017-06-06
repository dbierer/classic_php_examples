<?php
// XML example
$xml = <<<EOT
<?xml version="1.0"?>
<data>
    <users>
        <firstName>John</firstName>
        <lastName>Smith</lastName>
        <isAlive>1</isAlive>
        <age>25</age>
        <address>
            <street>21 2nd Street</street>
            <city>Toronto</city>
            <state_province>Ontario </state_province>
            <postalCode>MC3 0C1</postalCode>
        </address>
        <phone>111-222-3333</phone>
        <phone>444-555-6666</phone>
    </users>
</data>
EOT;
$obj = new SimpleXMLElement($xml);
// first + last names
$fullName = $obj->users->firstName . ' ' . $obj->users->lastName;
// get 1st phone number
$mainPhone = $obj->users->phone[0];
echo $fullName . '[' . $mainPhone . ']' . PHP_EOL;
// iterate through address data
foreach ($obj->users->address as $item) {
    var_dump($item);
}
// output XML
$obj->asXml();
// output XML to file
$obj->asXml('users.xml');
