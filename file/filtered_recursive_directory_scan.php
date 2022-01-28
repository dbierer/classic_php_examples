<?php
// returns a list of all files with the ALLOWED extensions
define('ALLOWED', ['htm','html']);

// looks for 1st CLI argument; defaults to current dir
$path  = $argv[1] ?? __DIR__;
$iter1 = new RecursiveDirectoryIterator($path);
$iter2 = new RecursiveIteratorIterator($iter1);

// this filters all except those with allowed extension
$filt  = new class ($iter2) extends FilterIterator {
    public function accept()
    {
        $splFileInfo = $this->current();
        return (in_array($splFileInfo->getExtension(), ALLOWED));
    }
};

// $name : absolute path to file
// $obj  : SplFileInfo instance
foreach ($filt as $name => $obj) {
    echo $name . PHP_EOL;
}
