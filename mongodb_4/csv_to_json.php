<?php
$out  = '';
$csv  = new SplFileObject(__DIR__ . DIRECTORY_SEPARATOR . 'sweets_products.csv', 'r');
while ($row = $csv->fgetcsv()) {
    if (isset($row[0])) {
        $data = [
            'sku' => trim($row[0]),
            'title' => trim($row[1]),
            'description' => substr($row[2], 0, 40),
            'price' => $row[3]
        ];
        $out .= 'db.products.insert(' . json_encode($data) . ');' . PHP_EOL;
    }
}
echo $out;
