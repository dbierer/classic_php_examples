<?php
spl_autoload_register(function ($class) {
    require_once __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
});

use App\Service\Manager;
use App\Lorem\Ipsum;
use App\Number\Prime;
use App\View\Paginate;

// load services
$container = new Manager();
$container->add(new Ipsum(), 'ipsum');
$container->add(new Prime(), 'prime');
$container->add(new Paginate(), 'paginate');

// get action from CLI
$output = '';
$action = trim($argv[1] ?? '');
switch ($action) {
    case 'ipsum' :
        $output = "Lorem Ipsum:\n";
        $contents = $container->get('ipsum')();
        preg_match_all('!<p>(.*?)</p>!', $contents, $matches);
        $output .= $matches[1][0] ?? 'Unknown';
        break;
    case 'prime' :
        $start = $argv[2] ?? 9000;
        $end   = $argv[3] ?? 9999;
        $primes = $container->get('prime')((int) $start, (int) $end);
        foreach ($primes as $number) $output .= $number . ' ';
        break;
    case 'page' :
        $limit  = (int) ($argv[2] ?? 20);
        $offset = (int) ($argv[3] ?? 0);
        $max    = (int) ($argv[4] ?? 100);
        $demo  = [];
        $pos   = 0;
        $alpha = range('a','z');
        // build demo array
        for ($x = 0; $x < $max; $x++) {
            $demo[$x] = str_repeat($alpha[$pos], 4);
            if (++$pos > 25) $pos = 0;
        }
        $data  = $container->get('paginate')($demo, $limit, $offset);
        $width = 4;
        $pos   = $width;
        foreach ($data as $number) {
            $output .= $number . ' ';
            if ($pos-- <= 0) {
                $pos = $width;
                $output .= PHP_EOL;
            }
        }
        break;
    default :
        $fn = 'php ' . basename(__FILE__);
        $output = 'Usage: '  . PHP_EOL
            . $fn . ' ipsum' . PHP_EOL
            . $fn . ' prime [start] [end]' . PHP_EOL
            . $fn . ' page  [limit] [offset] [max]' . PHP_EOL;
}
echo $output . PHP_EOL;
