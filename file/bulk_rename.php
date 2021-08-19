<?php
// renames files according to regex preg_replace() patterns
// CLI only!

$usage     = "Usage:\nphp bulk_rename.php [--dir=PATH] [--regex=REGEX] [--replace=STRING] [--prepend=PREFIX] [--start=STRING]\n"
           . "      REGEX is the 1st argument to 'preg_replace()'\n"
           . "      REPLACE is the 2nd argument to 'preg_replace()'\n"
           . "      If PATH is blank, defaults to current directory\n"
           . "      Use '--prepend=xxx' and '--start=yyy' in place of '--regex' and '--replace'\n"
           . "\n"
           . "Example: rename all *.jpg with *.jpeg\n"
           . "    php bulk_rename.php --regex='/(.*)\.jpg/' --replace='$1.jpeg'\n"
           . "Example: replace all imageXXX.jpg with demo_XXX.jpeg\n"
           . "    php bulk_rename.php --start=image --prepend=demo_\n";

// define functions

/**
 * Performs replacements and renames file using preg_replace
 *
 * @param string $fn = filename
 * @param string $search == 1st arg to preg_replace()
 * @param string $replace == 2nd arg to preg_replace()
 * @return string == revised filename
 */
function replace($fn, $search, $replace)
{
    if (!file_exists($fn)) return $fn;
    $path  = dirname($fn);
    $oldFn = basename($fn);
    $newFn = preg_replace($search, $replace, $oldFn);
    $newFn = str_replace('//', '/', $path . '/' . $newFn);
    if (basename($newFn) != basename($fn))
        rename($fn, $newFn);
    return $newFn;
}

/**
 * Prepends filename with $prepend if it starts with $start
 *
 * @param string $fn = filename
 * @param string $start == string eligible filename starts with
 * @param string $prepend == string to prepend to filename
 * @return string == revised filename
 */
function prepend($fn, $start, $prepend)
{
    if (!file_exists($fn)) return $fn;
    $path  = dirname($fn);
    $oldFn = basename($fn);
    if (strpos($oldFn, $start) !== 0) return $fn;
    $newFn = $prepend . $oldFn;
    $newFn = str_replace('//', '/', $path . '/' . $newFn);
    if (basename($newFn) != basename($fn))
        rename($fn, $newFn);
    return $newFn;
}

// init vars
$dir     = __DIR__;
$regex   = '';
$replace = '';
$start   = '';
$prepend = '';
$proceed = 0;

for ($x = 1; $x < count($argv); $x++) {
    if (empty($argv[$x])) break;
    if (strpos($argv[$x], '=') === FALSE) continue;
    [$arg, $val] = explode('=', $argv[$x]);
    switch ($arg) {
        case '--dir' :
            $dir = $val;
            break;
        case '--regex' :
            $regex = $val;
            $proceed++;
            break;
        case '--replace' :
            $replace = $val;
            $proceed++;
            break;
        case '--start' :
            $start = $val;
            $proceed++;
            break;
        case '--prepend' :
            $prepend = $val;
            $proceed++;
            break;
        default :
            echo "Invalid argument: $arg\n";
    }
}

if ($proceed < 2) {
    echo $usage;
    exit("Unable to continue\n");
}

echo 'Searching for ' . ($regex ?? $start) . PHP_EOL;

$it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir,  FilesystemIterator::SKIP_DOTS));

foreach($it as $name => $info) {
    echo 'Processing: ' . $name . PHP_EOL;
    if ($start) {
        $newFn = prepend($name, $start, $prepend);
    } else {
        $newFn = replace($name, $regex, $replace);
    }
    echo 'Replacement: ' . $newFn . PHP_EOL;
    $found[$name] = $newFn;
}
