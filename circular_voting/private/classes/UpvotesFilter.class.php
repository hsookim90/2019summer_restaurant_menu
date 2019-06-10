<?php

class UpvotesFilter implements iFilter
{
  //private function makeOrderDescending(&$array)
  public function updateItemsOrder(&$array)
	{
		uasort($array, array($this, "cmp"));
	}

	private function cmp($a, $b)
	{
		if ($a->hasLessUpvotes($b))
		{
			// note if want order ascending change return to -1.
			return 1;
		}
		elseif ($a->hasMoreUpvotes($b)) {
			// note if want order ascending change return to 1.
			return -1;
		}
		else {
			return 0;
		}
	}
}

?>
