<?php
class Users {
	
	public $name;
	public $photo;

	// This constructor accepts parameters
	function __construct( $a = "", $b = "") {
		$this->name = $a;
		if (file_exists($b)) {
			$this->photo = $b;
		} else {
			$this->photo = "default.png";
		}
	}
	
	function display() {
		echo "<p>";
		echo "<img src='" . $this->photo . "'/>";
		echo "<br />" . $this->name . "</p>\n";
	}
	
}

class usUsers extends Users {
	
	function showDate($time) {
		return date("l, F d, Y", $time);
	}
}

class frUsers extends Users {
	
	function showDate($time) {

		$jds = array( 	"Mon" => "lundi", "Tue" => "mardi", "Wed" => "mercredi", "Thu" => "jeudi",
						"Fri" => "vendredi", "Sat" => "samedi", "Sun" => "dimanche" );
	
		$mois = array ( "janvier", "février", "mars", "avril",  "mai", "juin", 
						"juillet", "août", "septembre", "octobre", "novembre", "décembre" );
	
		$jour = $jds[date("D",$time)];
		$ce_mois = $mois[(int)date("n",$time)-1];
		$num_de_jour = date("j",$time);
		$annee = date("Y",$time); 
		return "<br>" . $jour . " le " . $num_de_jour . " " . $ce_mois . " " .$annee;
	}
}

$user1 = new frUsers ("Nicolas Sarkozy", "ns.jpg");
$user2 = new usUsers ("Barack Obama", "bo.jpg");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<body>
<h1>Object Inheritance Example</h1>
<?php 
echo $user1->display(); 
echo $user1->showDate(time());
echo $user2->display(); 
echo $user2->showDate(time());
?>

</body>
</html>
