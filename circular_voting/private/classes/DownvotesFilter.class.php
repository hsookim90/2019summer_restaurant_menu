<?php

class DownvotesFilter implements iFilter
{
  public function setOrderDescending(&$array)
	{
		uasort($array, array('self', "cmpDecending"));
	}

  public function setOrderAscending(&$array)
	{
		uasort($array, array($this, "cmpAscending"));
	}

	private function cmpDecending($menuItemA, $menuItemB)
	{
		if ($menuItemA->hasLessDownvotes($menuItemB))
		{
			return 1;
		}
		elseif ($menuItemA->hasMoreDownvotes($menuItemB)) {
			return -1;
		}
		else {
			return 0;
		}
	}

	private function cmpAscending($menuItemA, $menuItemB)
	{
		if ($menuItemA->hasLessDownvotes($menuItemB))
		{
			return -1;
		}
		elseif ($menuItemA->hasMoreDownvotes($menuItemB)) {
			return 1;
		}
		else {
			return 0;
		}
	}
}
?>
