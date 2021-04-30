<?php
$dir = dirname(__FILE__);
$list = array();
foreach (new DirectoryIterator($dir) as $fileInfo) {
    if($fileInfo->isDot()) continue;
    $list[] = $fileInfo->getFilename();
}
natsort($list);
echo implode("<br>\n",$list);
?>
