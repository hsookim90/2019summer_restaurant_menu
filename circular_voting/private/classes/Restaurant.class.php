<?php

class Restaurant {
	private $itemCount = 0;
	private $name;
	private $address;
	private $phoneNum;
	private $website;
	private $menuItems = [];
	private $rating;
	private $hours;
	private static $restaurantCount = 0;
	private $restaurantID;
	// $currentFilter = new UpvotesFilter();

	function __construct($args=[])
	{
    $this->name = $args['name'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->phoneNum = $args['phoneNum'] ?? '';
    $this->website = $args['website'] ?? '';
    $this->rating = $args['rating'] ?? '';
    $this->hours = $args['hours'] ?? '';
    self::$restaurantCount++;
    $this->restaurantID = self::$restaurantCount;


		if (isset($args['menuItems']))
		{
			$this->initializeMenu($args['menuItems']);
		}

	}

	// not sure necessary in production
	// but nice way to quickly initialize menu items list in dev
	private function initializeMenu($menuItemsAsString)
	{
		foreach($menuItemsAsString as $item)
		{
			$this->createItem($item);
		}
		$this->printMenu();
	}

	// menuitem's itemNumber is dictated by where it is in the restaurant's item list
	// new items will be at the end of the list, therefore high item # is down on the list
	public function createItem($args=[])
	{
		$this->itemCount++;
		$itemCountArray=['itemCount'=>$this->itemCount];

		$menuItem = new MenuItem($args+$itemCountArray);
		//$this->menuItems[]=$menuItem;
		// changed menuItems from reg array to associative key value to address items by item number
		$this->menuItems[$this->itemCount] = $menuItem;

		echo $this->itemCount;
	}

	// TODO: delete item function, needed for user variable list

	// TODO: edit functions for moving up and down list,
	// 			 note will have to update itemNumber of menu items as well
	//

	public function printMenu()
	{
		echo "<section id='restaurant-" . h($this->restaurantID) . "'>";
		//echo "<section id='restaurant-id'>";

		foreach($this->menuItems as $key => $menuItem)
		{
			// $menuItem->printHTML();
			Display::printToScreen($menuItem->printHTML());
		}

		echo "</section>";
	}

	public function incrementUpVoteByItemNumber($number)
	{
		// menuItem's key should be the menu item
		$this->menuItems[$number]->incrementUpvote();
	}

	// item liked then want to put it in right position of array
	// 1. while loop compare and 2. swap
	// public function updatePositions($fromIndex = 0, $toIndex = count($this->menuItems))
	public function updatePositions($votedID, $fromIndex = 0, $toIndex = 0)
	{
		$filterObject = new UpvotesFilter();
		// return $this->currentFilter->findNewPosition($this->menuItems, $votedID, $fromIndex, $toIndex);
		// return $filterObject->findNewPosition($this->menuItems, $votedID, $fromIndex, $toIndex);
		return $filterObject->findNewPosition($this->menuItems, $votedID);

	}

	// TODO: convert to private, made public to test while making
	// note that if all equal, also passes
	public function isOrderDescending()
	{
		$orderDescending = true;

		$itemsValueArray = array_values($this->menuItems);

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

	// TODO make function private in production and delete direct unit tests
	public function makeOrderDescending()
	{
		uasort($this->menuItems, array($this, "cmp"));
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

	public function moveElement(&$array, $from, $to, $length = null)
	{
		if ($from===$to) return;

		$fromElementArray = array_slice($array, $from, 1, true);
		$keys = array_keys($array);
		unset($array[$keys[$from]]);

		// unset affects length for the next slice's length
		$unsetOffset = ($from < $to) ? -1 : 0;

		$tempArray = array_slice($array, 0, $to+$unsetOffset, true);
		$tempArray+=$fromElementArray;

		// 'to-1' to account for the unsetted element
		$array = $tempArray + array_slice($array, $to+$unsetOffset, count($array)-($to-1), true);
	}
}

?>
