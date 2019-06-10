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

	public function updatePositions()
	{
		$filterObject = new UpvotesFilter();
		$filterObject->updateItemsOrder($this->menuItems);
	}

	public function getMenuIDs()
	{
		$idsArray = [];
		foreach($this->menuItems as $key => $menuItem)
		{
			$idsArray[]=$key;
		}
		return $idsArray;
	}
}

?>
