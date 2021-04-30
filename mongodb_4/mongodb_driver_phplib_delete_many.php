<?php
// initialize env
require __DIR__ . '/vendor/autoload.php';
use Application\Client;

// set up mongodb client + collection
$params = ['host' => '127.0.0.1'];
$client = (new Client($params))->getClient();
$collection = $client->sweetscomplete->customers;

// here is the javascript query we wish to emulate:
/*
db.customers.deleteMany({balance:{$lte:0},name:{$ne:"admin"}},{name:1,balance:1});
*/

$filter = [
    'balance' => ['$lte' => 0],
    'name'    => ['$ne' => 'admin']
];
$options = ['projection' => ['name' => 1, 'balance' => 1]];
$cursor  = [];
$message = '';
try {
    if (isset($_POST['delete'])) {
        $result = $collection->deleteMany($filter);
        $message = 'Deleted ' . $result->getDeletedCount() . ' document(s)';
    } else {
        $cursor = $collection->find($filter,$options);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<html>
<body>
<b>Delete These Customers?</b>
<pre>
<?php foreach ($cursor as $document)
    printf('%20s : %6.2f' . PHP_EOL, $document->name, $document->balance) ?>
</pre>
</table>
<form method="post">
<input name="delete" value="Delete" type="submit" />
<input name="cancel" value="Cancel" type="submit" />
</form>
<b style="color:red;"><?= $message ?></b>
</body>
</html>
