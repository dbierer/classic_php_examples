<?php
class User {
	public function userAge($age) {
		$y = date("Y",time());
		echo "Born in " . (int) ($y - $age) . "\n";
	}
	protected function secretAge($age) {
		$age += 20;
		echo "This person is actually " . $age . " years old\n";
	}
}

class Child extends User {
	public function realAge($age) {
		$age = (int) $age;
		$this->secretAge($age);
	}
	protected function secretAge($age) {
		echo "Additional Functionality \n";
		parent::secretAge($age);
	}
}
$a = new Child();
$a->realAge(38);
echo $a->secretAge(38);
//$b = new User();
//$b->secretAge(48);
?>