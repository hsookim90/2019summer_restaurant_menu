<?php

class PriceFilter implements iFilter
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
		if ($menuItemA->comparePrice($menuItemB)<0)
		{
			return 1;
		}
		elseif ($menuItemA->comparePrice($menuItemB)>0) {
			return -1;
		}
		else {
			return 0;
		}
	}

	private function cmpAscending($menuItemA, $menuItemB)
	{
		if ($menuItemA->comparePrice($menuItemB)<0)
		{
			return -1;
		}
		elseif ($menuItemA->comparePrice($menuItemB)>0) {
			return 1;
		}
		else {
			return 0;
		}
	}
}
?>
