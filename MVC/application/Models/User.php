<?php
class Models_User
{
	protected $_adapter;
	public function __construct()
	{
		$this->_adapter = Models_Database::getAdapter();
	}
	public function getUserByName($username)
	{
		$sql = 'SELECT * FROM user WHERE username = ?';
		$stmt = $this->_adapter->prepare($sql);
		$stmt->execute(array($this->_adapter->quote($username)));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	public function insert(Array $data)
	{
		$sql = 'INSERT INTO user VALUE(?,?,?,?,?)';
		$stmt = $this->_adapter->prepare($sql);
		$stmt->execute($data);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
}