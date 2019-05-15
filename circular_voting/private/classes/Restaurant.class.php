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

		// TODO find itemCount from menut items array length
	}

	public function createItem($args=[])
	{
		$menuItem = new MenuItem($args);

		$menuItems[]=$menuItem;

		$var = $args['itemName'] ?? '';
		$this->itemCount+=5;
		echo $this->itemCount;



		$menuItem->printHTML();
	}
}

?>
