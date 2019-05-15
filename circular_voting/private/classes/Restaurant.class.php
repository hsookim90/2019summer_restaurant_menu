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
	// List of items
	// method to display item list
	// create item method to increment itemCount and pass itemNumber

	function __construct($args=[])
	{
    $this->name = $args['name'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->phoneNum = $args['phoneNum'] ?? '';
    $this->website = $args['website'] ?? '';
    // $this->menuitems = $args['menu_items'] ?? '';
    $this->rating = $args['rating'] ?? '';
    $this->hours = $args['hours'] ?? '';

    // $this->menuitems = $args['menuItems'] ?? [];
    // $menuItemsAsString = $args['menuItems'] ?? [];

		if (isset($args['menuItems']))
		{
			$this->initializeMenu($args['menuItems']);
		}

	}

	private function initializeMenu($menuItemsAsString)
	{
		foreach($menuItemsAsString as $item)
		{
			// $this->itemCount++;
			// $itemCountArray=['itemCount'=>$this->itemCount];
			// createItem(array_merge($menuItemsAsString, $itemCountArray));

			// createItem($menuItemsAsString + $itemCountArray);
			$this->createItem($item);
		}
	}

	public function createItem($args=[])
	{
		$this->itemCount++;
		$itemCountArray=['itemCount'=>$this->itemCount];

		$menuItem = new MenuItem($args+$itemCountArray);
		$this->menuItems[]=$menuItem;

		// $this->itemCount+=5;
		echo $this->itemCount;



		$menuItem->printHTML();
	}

	// TODO: delete item function
}

?>
