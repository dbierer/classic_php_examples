<?php
$data  = [];
$alpha = range('A','Z');
// this infinitely loops through letters of the alphabet
$iter  = new InfiniteIterator(new ArrayIterator($alpha));
$iter->rewind();
for ($x = 1000; $x <= 9999; $x++) {
    // next letter of the alphabet
    $data[$x] = str_repeat($iter->current(), 6);
    $iter->next();
}
// sort but retain keys
asort($data);
// output 1st 20 entries
for ($x = 0; $x < 20; $x++) {
    echo key($data) . ':' . current($data) . "\n";
    next($data);
}
/* Output:
PHP 7           PHP 8
1000:AAAAAA     1000:AAAAAA
8176:AAAAAA     1026:AAAAAA
8072:AAAAAA     1052:AAAAAA
5082:AAAAAA     1078:AAAAAA
1858:AAAAAA     1104:AAAAAA
8098:AAAAAA     1130:AAAAAA
5056:AAAAAA     1156:AAAAAA
8124:AAAAAA     1182:AAAAAA
5030:AAAAAA     1208:AAAAAA
8150:AAAAAA     1234:AAAAAA
5004:AAAAAA     1260:AAAAAA
4978:AAAAAA     1286:AAAAAA
4952:AAAAAA     1312:AAAAAA
5108:AAAAAA     1338:AAAAAA
8202:AAAAAA     1364:AAAAAA
1884:AAAAAA     1390:AAAAAA
4926:AAAAAA     1416:AAAAAA
1312:AAAAAA     1442:AAAAAA
4900:AAAAAA     1468:AAAAAA
8228:AAAAAA     1494:AAAAAA
*/
