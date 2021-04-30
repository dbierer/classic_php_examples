<?php
// Produces a list of "sku" numbers which goes into an HTML <select>
// Choose a number
// Creates an object of type 'Product' using FETCH_CLASS mode

// Define Product class
class Product {

	protected $value;
	
	protected $cols;
	// $mappings allows you to hide the actual column name
	protected $mappings = array('sku' 	=> 's',
								'pid'	=> 'p',
								'unit'	=> 'u',
								'qty_oh'=> 'q',
								'cost'	=> 'c',
                                'description' => 'd',
			);	 
	
	public function __construct($value = NULL)
	{
		$this->value = $value;
	}
	
	public function __set($name, $value) {
		// as PDO assigns values, column names are converted into mapping value
		$this->cols[$this->mappings[$name]] = $value;
	}
	 
	public function __get($name) {
		// getter uses mapping value instead of actual column name
		return $this->cols[$name];
	}
	
	public function calc() {
		return $this->cols['q'] * $this->cols['c'];
	}

}

// Initialize variables
$line = array();
$message = '';

// Get search string
$search = isset($_GET['Search']) ? (int) $_GET['Search'] : "";

// Create database connection
$pdo = include 'get_pdo.php';

try {

	$result = NULL;
	$product = new Product();
	
	// Proceed if the "OK" button was pressed
	if ( isset($_GET['OK'])) {

		// SQL prepare
		$sql = "SELECT * FROM products WHERE sku = ? LIMIT 1;";
		$sth = $pdo->prepare($sql);
		// fetches "into" an object
		$sth->setFetchMode(PDO::FETCH_CLASS, 'Product', array('test'));
		$sth->execute(array($search));
		$result = $sth->fetch();
		
	}
	
	// Pull list of SKU numbers
	$sql = "SELECT sku FROM products;";
	$sth = $pdo->prepare($sql);
	$sth->execute();
	while ( $line = $sth->fetch(PDO::FETCH_NUM)) {		
    	// Stuff SKU into its own array
    	$sku_list[] = $line[0];
	}

} catch (PDOException $e) {

	$message = $e->getMessage();

}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Product Search</title>
<style>
TD {
	font: 10pt helvetica, sans-serif;
	border: thin solid black;
	}
TH {
	font: bold 10pt helvetica, sans-serif;
	border: thin solid black;
	}
</style>
</head>
<body>
<h1>Product Search</h1>
<!--  This is how the same script is called -->
<form name="ProductSearch" method=GET>
<h2>PDO Fetch Class Test</h2>
<table border=1>
	<tr>
		<th>Search For:</th>
		<td>
			<select name="Search">
				<option>SKU</option>
				<?php
				// Iterate through $sku_list
				sort($sku_list);
				foreach ( $sku_list as $item ) {
					echo "<option>" . $item . "</option>\n"; 
				}
				?>
			</select>
			&nbsp;&nbsp;<input type=submit name="OK" value="OK" />
		</td>
	</tr>
	<?php if ($result) : ?>
	<tr>
		<th>SKU</th>
		<td><?php echo $result->s; ?></td>
	</tr>
	<tr>
		<th>Product ID</th>
		<td><input type=text name="PID" value="<?php echo $result->p; ?>" /></td>
	</tr>
	<tr>
		<th>Unit</th>
		<td><input type=text name="Unit" value="<?php echo $result->u; ?>" /></td>
	</tr>
	<tr>
		<th>Cost</th>
		<td><input type=text name="Cost" value="<?php echo $result->c; ?>" /></td>
	</tr>
	<tr>
		<th>Qty On Hand</th>
		<td><input type=text name="Qty" value="<?php echo $result->q; ?>" /></td>
	</tr>
	<tr>
		<th>Extended Cost</th>
		<td>
		<?php 
			echo "$";
			echo $result->calc();
		?>
		</td>
	</tr>
	<?php endif; ?>
</table>
</form>
<br><a href="index.php">BACK</a>
<?php 
if ($message) { echo $message; }
var_dump($result); 
phpinfo(INFO_VARIABLES);
?>
</body>
</html>
