<?php

class UpvotesFilter implements iFilter
{

  // TODO this function does not work order by ascending votes will have to change later
  // public function findNewPosition(&$array, $votedID, $fromIndex = 0, $toIndex = 0)
  public function findNewPosition(&$array, $votedID)
  {
    $this->updateItemsOrder($array);

    // $step = $fromIndex>=$toIndex ? -1: 1;
    $step = -1;

    if ($this->isOrderDescending($array) && isset($array[$votedID]))
    {
      // commented out b/c filter shouldn't be incrementing anything
      // $array[$votedID]->incrementUpvote();

      $arrValues = array_values($array);
      $arrKeys = array_keys($array);

      $position = array_search($votedID, $arrKeys);

      $shiftedPosition = $position;

      // note descending not gonna work here due to $i<, best to do interface behaviour parameterizaiton instead
      // TODO: change to above comment later
      $currItem = $arrValues[$position];
      // for ($i = $position; $i>$toIndex; $i+=$step)
      for ($i = $position; $i>0; $i+=$step)
      {
          $comparedItem = $arrValues[$i+$step];
          if ($currItem->hasMoreUpvotes($comparedItem))
          {
            $shiftedPosition+=$step;
          }
          else {
            break;
          }
      }
      return $shiftedPosition;
    }
  }


	private function isOrderDescending(&$array)
	{
		$orderDescending = true;

		$itemsValueArray = array_values($array);

		$arrLength = count($itemsValueArray);
		// $arrLength = 3;
		$currIndex = 0;

		while ($currIndex < ($arrLength-1) && $orderDescending!==false)
		{
			$currItem = $itemsValueArray[$currIndex];
			$nextItem = $itemsValueArray[$currIndex+1];
			if($currItem->hasLessUpvotes($nextItem))
			{
				$orderDescending = false;
			}
			$currIndex++;
		}

		return $orderDescending;
	}

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
