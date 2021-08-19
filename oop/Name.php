<?php
class Name
{
	public function getName($firstname, $lastname, $middleinitial = '')
	{    
		$fname = ucfirst($firstname);    
		$ln = ucfirst($lastname);
		if ($middleinitial) $middleinitial = ucfirst($middleinitial) . '.';         
		return "$fname, $ln $middleinitial";
	}
}

