<?php
namespace App\Number;

use Generator;
class Prime
{
    const START  = 1000;
    const END    = 9999;
    /**
     * Generates prime numbers between start and end
     *
     * @param int $start : where to start generating primes
     * @param int $end   : where to end generation
     * @return Generator
     */
    public function __invoke(int $start = self::START, int $end = self::END) : Generator
    {
        for ($x = $start; $x < $end; $x++)
        {
            // This if evaluation checks to see if number is odd or even
            $test = TRUE;
            for($i = 3; $i < $x; $i++) {
                if(($x % $i) === 0) {
                    $test = FALSE;
                    break;
                }
            }
            if ($test) yield $x;
        }
    }
}
