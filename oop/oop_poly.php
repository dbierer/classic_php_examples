<?php 
// Class definition
class User {
	private $name;
	function __construct($a) {
		$this->name = $a;
	}
	function getName() {
		return $this->name;
	}
}
// Child class
class AdminUser extends User {
	public $permissions;
	function show () {
		echo $this->name;
	}
}
// Some function
function display_name(User $u) {
	echo $u->getName();
}
// Define instance
$user = new AdminUser("Joe");
// Property was added by child class
$user->permissions = "ALL";
// Still works even though parent class was specified 
display_name($user);
// Test private
$user->show();
echo $user->name;
?>