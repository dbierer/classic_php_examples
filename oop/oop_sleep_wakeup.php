<?php
class User{
    protected string $firstName;
    protected string $lastName;
    protected string $userName;
    protected string $hash;
    public function __construct(string $firstName, string $lastName, string $password='')
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $firstName . ' ' . $lastName;
        if (!empty($hash)) {
			$this->hash = password_hash($password, PASSWORD_DEFAULT);
		} else {
			$this->__wakeup();
		}
    }
    public function __sleep()
    {
		return ['firstName','lastName','userName'];
	}
	public function __wakeup()
	{
		$password = bin2hex(random_bytes(8));
		$this->hash = password_hash($password, PASSWORD_DEFAULT);
	}
    public function confirmPassword(string $password) : bool
    {
		return password_verify($password, $this->hash);
	}
	public function __toString()
	{
		return json_encode(get_object_vars($this), JSON_PRETTY_PRINT);
	}
}

$user = new User('Fred','Flintstone');
$str  = serialize($user);
$new  = unserialize($str);
echo $str;	// does not include $hash in serialization string
echo $new;	// __wakeup() generates new  hash

$json = json_encode($user);
$new2 = json_decode($json);
//echo $new2;

var_dump($user);
var_dump($new);
var_dump($new2);
