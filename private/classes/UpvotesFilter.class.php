<?php
/*
	Sorts menu items by upvote number.
	@author Glenn <jayasugp@myumanitoba.ca>
*/

class UpvotesFilter implements iFilter
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
		if ($menuItemA->hasLessUpvotes($menuItemB))
		{
			return 1;
		}
		elseif ($menuItemA->hasMoreUpvotes($menuItemB)) {
			return -1;
		}
		else {
			return 0;
		}
	}

	private function cmpAscending($menuItemA, $menuItemB)
	{
		if ($menuItemA->hasLessUpvotes($menuItemB))
		{
			return -1;
		}
		elseif ($menuItemA->hasMoreUpvotes($menuItemB)) {
			return 1;
		}
		else {
			return 0;
		}
	}
}
?>
