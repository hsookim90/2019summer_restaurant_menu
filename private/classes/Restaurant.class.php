<?php

class Restaurant
{
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
	private $filterObject;

	function __construct($args=[])
	{
		$this->name = $args['name'] ?? '';
		$this->address = $args['address'] ?? '';
		$this->phoneNum = $args['phoneNum'] ?? '';
		$this->website = $args['website'] ?? '';
		$this->rating = $args['rating'] ?? '';
		$this->hours = $args['hours'] ?? '';
		$this->type = $args['type'] ?? '';
		self::$restaurantCount++;
		$this->restaurantID = self::$restaurantCount;
		$this->filterObject = new UpvotesFilter();

		if (isset($args['menuItems']))
		{
			$this->initializeMenu($args['menuItems']);
		}

	}

	// not sure necessary in production
	// but nice way to quickly initialize menu items list in dev
	private function initializeMenu($menuItemsAsString)
	{
		foreach ($menuItemsAsString as $item)
		{
			$this->createItem($item);
		}
		$this->updatePositions();
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

	// json encode reference: https://www.dyn-web.com/tutorials/php-js/json/multidim-arrays.php
	public function getAllItemsDetails()
	{
		$allItemsDetails = [];
		foreach($this->menuItems as $key => $menuItem)
		{
			$allItemsDetails[] = $menuItem->getItemDetails();
		}
		// echo json_encode($allItemsDetails);
		return $allItemsDetails;
	}

	public function incrementUpVoteByItemNumber($number)
	{
		// menuItem's key should be the menu item
		$this->menuItems[$number]->incrementUpvote();
	}

	public function incrementDownVoteByItemNumber($number)
	{
		// menuItem's key should be the menu item
		$this->menuItems[$number]->incrementDownvote();
	}


	public function updatePositions()
	{
		$className = get_class($this->filterObject);
		if ($className == 'AlphaFilter' || $className =='PriceFilter')
		{
			$this->filterObject->setOrderAscending($this->menuItems);
		}
		else
		{
			$this->filterObject->setOrderDescending($this->menuItems);
		}
	}

	public function setFilter($filter)
	{
		switch ($filter) {
			case 'upvotes':
				$this->filterObject = new UpvotesFilter();
				break;
			case 'downvotes':
				$this->filterObject = new DownvotesFilter();
				break;
			case 'alpha':
				$this->filterObject = new AlphaFilter();
				break;
			case 'price':
				$this->filterObject = new PriceFilter();
				break;
			default:
				$this->filterObject = new UpvotesFilter();
				break;
		}
		// i think to call updatePositions b/c after u click a filter u expect the positions to change
		$this->updatePositions();
	}

	public function ajaxJSONEncode()
	{
		echo json_encode($this->getAllItemsDetails());
	}
}

?>
