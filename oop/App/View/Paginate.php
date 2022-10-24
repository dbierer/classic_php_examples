<?php
namespace App\View;

use ArrayIterator;
use LimitIterator;
class Paginate
{
    /**
     * Produces limited output
     *
     * @param array $data : data to paginate
     * @param int $limit  : how many items in pagination
     * @param int $offset : where to start pagination
     * @return LimitIterator
     */
    public function __invoke(array $data, int $limit, int $offset = 0) : LimitIterator
    {
        $iterator = new ArrayIterator($data);
        $limit = new LimitIterator($iterator, $offset, $limit);
        return $limit;
    }
}
