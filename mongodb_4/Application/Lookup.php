<?php
namespace Application;

use Throwable;
use MongoDB\BSON\Regex;

/**
 * Produces JSON results for lookups from sweetscomplete.* collections
 * Used by json.php
 */
class Lookup extends Base
{

    /**
     * Returns array of customer names
     *
     * @param string $term = search key chars
     * @return array $customers = ['<name>' => '<name>']
     */
    public function getListOfCustomers($term)
    {
        // build find() options
        $filter = NULL;
        if ($term) {
            $regex = new Regex($term, 'i');
            $filter = ['name' => $regex];
        }
        $options = [
            'sort'  => ['name' => 1],
            'projection' => ['name' => 1]
        ];

        // perform find
        $result  = [];
        try {
            $cursor     = $this->find($this->customers, $filter, $options);
            foreach ($cursor as $document) {
                //$result[] = var_export($document, TRUE);
                $result[$document->name] = $document->name;
            }
        } catch (Throwable $e) {
            error_log(__METHOD__ . ':' . $e->getMessage());
            $result[] = 'ERROR: unable to find customers';
        }
        return $result;
    }
    /**
     * Returns array of product titles
     *
     * @param string $term = search key chars
     * @return array $products = ['<sku>' => '<title>']
     */
    public function getListOfProducts($term)
    {
        // build find() options
        $filter = NULL;
        if ($term) {
            $regex = new Regex($term, 'i');
            $filter = ['title' => $regex];
        }
        $options = [
            'sort'  => ['title' => 1],
            'projection' => ['sku' => 1, 'title' => 1]
        ];

        // perform find
        $result  = [];
        try {
            $cursor     = $this->find($this->products, $filter, $options);
            foreach ($cursor as $document) {
                //$result[] = var_export($document, TRUE);
                $result[] = $document->title . ' [' . $document->sku . ']';
            }
        } catch (Throwable $e) {
            error_log(__METHOD__ . ':' . $e->getMessage());
            $result[] = 'ERROR: unable to find products';
        }
        return $result;
    }
    /**
     * Returns list of purchases by date
     *
     * @param string $start_date
     * @param string $end_date
     * @param int $limit
     * @return string $result in JSON format
     */
    public function getListOfPurchasesByDate($start_date, $end_date, $limit = self::DEFAULT_LIMIT)
    {

        // build find() filter
        if ($end_date) {
            $filter  = [
                '$and' => [
                    ['date' => ['$gte' => $start_date]],
                    ['date' => ['$lte' => $end_date]]
                ]
            ];
        } else {
            $filter  = [
                'date' => ['$gte' => $start_date],
            ];
        }

        // build find() options
        $options = [
            'limit' => $limit,
            'sort'  => ['date' => 1],
            'projection' => ['customer.name' => 1, 'product.title' => 1, 'amount' => 1, 'date' => 1]
        ];

        // perform find
        $result  = [];
        try {
            $cursor     = $this->find($this->purchases, $filter, $options);
            foreach ($cursor as $document) {
                //$result[] = var_export($document, TRUE);
                $result[] = [$document->customer->name,
                             $document->product->title,
                             sprintf('%.2f', $document->amount),
                             $document->date];
            }
        } catch (Throwable $e) {
            error_log(__METHOD__ . ':' . $e->getMessage());
            $result[] = 'ERROR: unable to find purchases for these dates: ' . $start_date . ' to ' . $end_date;
        }
        return $result;
    }
    /**
     * Wrapper for db.collection.find()
     * Accepts optional filter and projection
     *
     * @param MongoDB\Collection $collection
     * @param mixed $filter = filter criteria | NULL
     * @param array $options = fields to include or exclude
     * @return array $results
     */
    public function find($collection, $filter = NULL, array $options = [])
    {
        $result = [];
        if ($filter && $options) {
            $result = $collection->find($filter, $options);
        } elseif ($options && !$filter) {
            $result = $collection->find([], $options);
        } elseif ($filter && !$options) {
            $result = $collection->find($filter);
        } else {
            $result = $collection->find();
        }
        return $result;
    }
}
