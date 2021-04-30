<?php
$handle = fopen("users.txt", "r");
while ($userinfo = fscanf($handle, "%s\t%s\t%s\t%8d\n")) {
    list ($name, $profession, $countrycode,$amount) = $userinfo;
    echo "Name      : " . $name . PHP_EOL; 
    echo "Profession: " . $profession. PHP_EOL; 
    echo "Country   : " . $countrycode. PHP_EOL;
	echo "Amount    : " . $amount . PHP_EOL;
    echo PHP_EOL; 
}
fclose($handle);
?>