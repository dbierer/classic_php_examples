<?php
namespace models;
class Soap {
	public function getArticles()
	{
		$return = array();
		foreach (Blogs::getEntries() as $entry) {
			$ent = array();
			foreach ($entry as $key => $val) {
				$ent[$key] = utf8_encode($val);
			}
			$return[] = $ent;
		}
		return $return;
	}
}
?>
