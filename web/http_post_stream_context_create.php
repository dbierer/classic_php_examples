<?php
// POST https://api.unlikelysource.com/post_test.php
$data = ['name' => 'Test', 'date' => date('Y-m-d H:i:s')];
$html = http_build_query($data);
$options = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded' . "\r\n"
                    . 'Content-Length: ' . strlen($html),
        'content'   => $html,
    ]
];
$context = stream_context_create($options);
$resource = fopen('https://api.unlikelysource.com/post_test.php', 'r', false, $context);
while (!empty($line = fgets($resource))) {
    echo $line . PHP_EOL;
}
fclose($resource);
// output:
/*
array ('name' => 'Test','date' => '2025-09-16 09:03:09')
*/
