<?php
$contents = file_get_contents("http://www.google.com/finance/company_news?q=CURRENCY:GBP&output=rss");
var_dump($contents);
?>