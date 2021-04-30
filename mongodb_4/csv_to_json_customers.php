<?php
$out  = '';
$csv  = new SplFileObject(__DIR__ . DIRECTORY_SEPARATOR . 'sweets_customers.csv', 'r');
$fields = ['name','address','city','state_province','postal_code','country','phone','balance','email','password'];

// insertOne()
while ($row = $csv->fgetcsv()) {
    if (isset($row[0])) {
        $data = array_combine($fields, $row);
        //$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $out .= 'db.customers.insertOne(' . json_encode($data) . ');' . PHP_EOL;
        $out .= 'db.customers.updateOne({"email":"' . $data['email'] . '"},{$unset:{"password":1}});' . PHP_EOL;
    }
}
echo $out;

// insertMany()
/*
$inner = '';
$row = $csv->fgetcsv();
for ($x = 0; $x < 6; $x++) {
    $row = $csv->fgetcsv();
    if (isset($row[0])) {
        $data = array_combine($fields, $row);
        $toGo = ['name' => $data['name'], 'email' => $data['email']];
        $inner .= '    ' . json_encode($toGo) . ',' . PHP_EOL;
    }
}
$out = 'db.customers.insertMany(' . PHP_EOL . '  [' . PHP_EOL . $inner . '  ]' . PHP_EOL . ');' . PHP_EOL;
echo $out;
*/
