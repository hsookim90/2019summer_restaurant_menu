<?php
/*
	Sorts menu items alphabetically.
	@author Glenn <jayasugp@myumanitoba.ca>
*/

class AlphaFilter implements iFilter
{
  public function setOrderDescending(&$array)
	{
		usort($array, array('self', "cmpDecending"));
	}

  public function setOrderAscending(&$array)
	{
		usort($array, array($this, "cmpAscending"));
	}

	private function cmpDecending($menuItemA, $menuItemB)
	{
		if ($menuItemA->compareNames($menuItemB)<0)
		{
			return 1;
		}
		elseif ($menuItemA->compareNames($menuItemB)>0) {
			return -1;
		}
		else {
			return 0;
		}
	}

	private function cmpAscending($menuItemA, $menuItemB)
	{
		if ($menuItemA->compareNames($menuItemB)<0)
		{
			return -1;
		}
		elseif ($menuItemA->compareNames($menuItemB)>0) {
			return 1;
		}
		else {
			return 0;
		}
	}
}
?>
