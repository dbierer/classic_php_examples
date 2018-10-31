<?php
namespace Application;

use Throwable;
use MongoDB\Model\BSONDocument;

/**
 * Used by add.php to add a new purchase to the database
 */
class Add extends Base
{

    /**
     * Returns customer document
     *
     * @return MongoDB\Model\BSONDocument $customer
     */
    public function findCustomerByName($name)
    {

        // build projection: these are the fields we will include in the purchase
        $options = [
            'projection' => [
                '_id' => 1,
                'name' => 1,
                'state_province' => 1,
                'country' => 1,
                'balance' => 1,
                'purch_history' => 1
            ]
        ];
        // perform find
        $result  = NULL;
        try {
            $result = $this->customers->findOne(['name' => $name], $options);
        } catch (Throwable $e) {
            error_log(__METHOD__ . ':' . $e->getMessage());
        }
        return $result;
    }
    /**
     * Returns product document
     *
     * @return MongoDB\Model\BSONDocument $product
     */
    public function findProductBySku($sku)
    {

        // build projection: in the purchase we suppress the description
        $options = ['projection' => ['description' => 0]];
        // perform find
        $result  = NULL;
        try {
            $result = $this->products->findOne(['sku' => $sku], $options);
        } catch (Throwable $e) {
            error_log(__METHOD__ . ':' . $e->getMessage());
        }
        return $result;
    }
    /**
     * Insert new purchase without transaction support
     *
     * @param MongoDB\Model\BSONDocument $customer
     * @param MongoDB\Model\BSONDocument $product
     * @param int $quantity
     * @return boolean $result
     */
    public function savePurchase(BSONDocument $customer, BSONDocument $product, $quantity)
    {
        $result = FALSE;
        $date = date(self::DATE_FORMAT);
        $session = $this->connection->getSession();
        $data = [
            'customer' => $customer,
            'product'  => $product,
            'date'     => $date,
            'quantity' => $quantity,
            'amount'   => $quantity * (float) $product->price
        ];
        try {
            if ($result = $this->purchases->insertOne($data)) {
                // add date to customer purchase history
                $list = $customer->purch_history;
                $list[] = $date;
                $this->customers->updateOne(
                    ['name' => $customer->name],
                    ['$set' => ['purch_history' => $list]]);
            }
        } catch (Throwable $e) {
            $result = FALSE;
            error_log(__METHOD__ . ':' . $e->getMessage());
        }
        return $result;
    }
    /**
     * Insert new purchase with transaction support(only available in MongoDB v4.0+)
     * See: https://docs.mongodb.com/manual/core/transactions/#transactions
     * Can only run on a replica set!!!
     *
     * @param MongoDB\Model\BSONDocument $customer
     * @param MongoDB\Model\BSONDocument $product
     * @param int $quantity
     * @return boolean $result
     */
    public function savePurchaseWithSession(BSONDocument $customer, BSONDocument $product, $quantity)
    {
        // init vars
        $result = FALSE;
        $date = date(self::DATE_FORMAT);

        // get MongoDB\Driver\Session which is used for transaction support
        $session = $this->connection->getSession();
        $data = [
            'customer' => $customer,
            'product'  => $product,
            'date'     => $date,
            'quantity' => $quantity,
            'amount'   => $quantity * (float) $product->price
        ];
        try {
            // begin transaction
            $session->startTransaction();
            // need to add session as an option to get transaction support
            if ($result = $this->purchases->insertOne($data, ['session' => $session])) {
                $list = $customer->purch_history;
                $list[] = $date;
                $this->customers->updateOne(
                    ['name' => $customer->name],
                    ['$set' => ['purch_history' => $list]],
                    // need to add session as an option to get transaction support
                    ['session' => $session]);
            }
            // commit
            $session->commitTransaction();
        } catch (Throwable $e) {
            // rollback
            $session->abortTransaction();
            $result = FALSE;
            error_log(__METHOD__ . ':' . $e->getMessage());
        }
        return $result;
    }
}
