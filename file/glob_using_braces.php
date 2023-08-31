<?php
$list = glob(__DIR__ . '/*.{php,csv,txt}', GLOB_BRACE);
printf("%30s\t%d\t%d\n",'Name','Size','Lines');
foreach ($list as $fn) {
    printf("%30s\t%d\t%d\n",
           substr(basename($fn),0,30),
           filesize($fn),
           count(file($fn)));
}
