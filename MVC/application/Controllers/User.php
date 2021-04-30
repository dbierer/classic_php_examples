<?php
class Controllers_User
{
	protected $view;

	public function loginStart()
	{
		$this->view->body[0] = PHP_EOL
							 . '<form method="POST" action="/mvc/user/loginConfirm">' . PHP_EOL
							 . 'Username: <input type="text" name="name" />' . PHP_EOL
							 . '<br />' . PHP_EOL
							 . 'Password: <input type="password" name="password" />' . PHP_EOL
							 . '<br />' . PHP_EOL
							 . '<input type="submit" />' . PHP_EOL
							 . '</form>' . PHP_EOL;
	}
	public function loginConfirm()
	{
		$userTable = new Models_User();
		$username = (isset($_POST['name'])) ? strip_tags($_POST['name']) : 'guest';
		$password = (isset($_POST['password'])) ? strip_tags($_POST['password']) : '';
		$dataRow = $userTable->getUserByName($username);
		if (count($dataRow) > 0) {
			if ($dataRow['password'] == $password) {
				$_SESSION['authenticated'] = TRUE;
			} else {
				$_SESSION['authenticated'] = FALSE;
			}
			$_SESSION['username'] = $username;
		}
		$this->view->head['title'] = '<title>Login</title>';
		$this->view->body[0] = '<h1>WELCOME</h1>';
		$this->view->body[1] = $_SESSION['username'];
	}
	
	public function setView($view)
	{
		$this->view = $view;
	}
}