<?php
// renames files according to regex preg_replace() patterns
// CLI only!

define('DEFAULT_FN_FILTER', '/./');     // i.e. any character

$usage     = "Usage:\nphp bulk_rename.php <SEARCH_REGEX> <REPLACE_REGEX> [<START_DIR>]\n"
           . "      SEARCH_REGEX is the 1st argument to 'preg_replace()'\n"
           . "      REPLACE_REGEX is the 2nd argument to 'preg_replace()'\n"
           . "      If START_DIR is blank, defaults to current directory\n"
           . "\n"
           . "Example: rename all *.jpg with *.jpeg\n"
           . "    php bulk_rename.php '/(.*)\.jpg/' '$1.jpeg'\n";

$search    = $argv[1] ?? '';
$replace   = $argv[2] ?? '';
$start_dir = $argv[3] ?? __DIR__;
$found     = [];
// define functions
/**
 * Performs replacements and renames file
 *
 * @param string $fn = filename
 * @param string $search == 1st arg to preg_replace()
 * @param string $replace == 2nd arg to preg_replace()
 * @return string == revised filename
 */
function replace($fn, $search, $replace)
{
    if (!file_exists($fn)) return FALSE;
    $path  = dirname($fn);
    $oldFn = basename($fn);
    $newFn = preg_replace($search, $replace, $oldFn);
    $newFn = str_replace('//', '/', $path . '/' . $newFn);
    if (basename($newFn) != basename($fn))
        rename($fn, $newFn);
    return $newFn;
}
if (!$search || !$replace) {
    echo $usage;
    exit('Unable to continue');
}

echo 'Searching for ' . $search . PHP_EOL;

$it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($start_dir,  FilesystemIterator::SKIP_DOTS));

foreach($it as $name => $info) {
    echo 'Processing: ' . $name . PHP_EOL;
    $newFn = replace($name, $search, $replace);
    echo 'Replacement: ' . $newFn . PHP_EOL;
    $found[$name] = $newFn;
}
