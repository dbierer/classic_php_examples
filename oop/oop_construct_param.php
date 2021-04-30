<?php
//error_reporting(E_ALL);
//ini_set("display_errors",1);
class Photo {
	
	public $photo;		// photo filename
	public $width;
	public $height;
	public $name;
		
	// This constructor accepts parameters
	function __construct( $fn = "") {
		// PHP 4
//	function Photo( $fn ) {
		if (file_exists($fn)) {
			$this->photo = $fn;
		} else {
			$this->photo = "default.png";
		}
		if (file_exists($this->photo)) {
			list($this->width,$this->height) = getimagesize($this->photo);
		} else {
			$this->width = 100;
			$this->height = 100;
		}
	}
	
	function display() {
		echo "<p>";
		echo "<img src='" . $this->photo . 
				"' width='" . $this->width . 
				"' height='" . $this->height . "' />";
		echo "<br />" . $this->name . "</p>\n";
	}
	
	function dump () {
		echo "<br />";
		var_dump($this);
	}
	
}

$photo2 = new Photo ();
$photo2->name = "Some Guy";
$photo1 = new Photo ("gw.jpg");
$photo1->name = 'GW Bush';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<h1>Object Constructor with Parameters Example</h1>
<?php 
$photo1->display("GW Bush");
$photo2->display("Some Guy"); 
?>
<pre>
<?php 
$photo1->dump();
$photo2->dump();
echo "<br />" . $photo1->width;
?>
</pre>
</body>
</html>
