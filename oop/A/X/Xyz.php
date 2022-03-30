<?php
namespace A\X;
class Xyz
{
	// you can pre-type the data type in PHP 7.4+
	protected string $fname = '';
	public string $lname = '';
	private $token = 123456;
	public function getDate()
	{
		return date('Y-m-d');
	}
	public function setFname(string $name)
	{
		return $this->fname = $name;
	}
	public function getFname()
	{
		return $this->fname;
	}
	public function getInfo()
	{
		$str = $this->getDate() . "\n";
		$str .= $this->fname . ' ' . $this->lname;
		return $str;
	}
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
}


