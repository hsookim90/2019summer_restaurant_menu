<?php

class Restaurant {
	private $itemCount = 0;
	private $name;
	private $address;
	private $phoneNum;
	private $website;
	private $rating;
	private $hours;
	private static $restaurantCount = 0;
	private $restaurantID;
	private $filterObject;
	private $menuDBItems = [];
	private $menuDB2Items = [];
	private $menuDBReg = [];

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
		$this->filterObject = new UpvotesFilter();

		if (isset($args['menuDBItems']))
		{
			$this->menuDBItems = $args['menuDBItems'];
			foreach($this->menuDBItems as $item)
			// foreach($this->$args['menuDBItems'] as $item)
			{
				$this->addToMenuArray($item);
			}
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
		$this->updatePositions();
	}

	private function addToMenuArray($item)
	{
		$this->itemCount++;
		$this->menuDB2Items[$this->itemCount] = $item;
		$this->menuDBReg[] = $item;
	}

	// menuitem's itemNumber is dictated by where it is in the restaurant's item list
	// new items will be at the end of the list, therefore high item # is down on the list
	public function createItem($args=[])
	{
		$this->itemCount++;
		$itemCountArray=['itemCount'=>$this->itemCount];

		$menuItem = new MenuItem($args+$itemCountArray);
		// $result = $menuItem->save();
		// if($result === true) {
			// should check if save worked
		// } else {
			// show errors
		// }

		//$this->menuItems[]=$menuItem;
		// changed menuItems from reg array to associative key value to address items by item number
		$this->menuItems[] = $menuItem;

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

	public function incrementUpVoteByItemNumber($position)
	{
		// menuItem's key should be the menu item
		// $this->menuItems[$number]->incrementUpvote();

		// $item = MenuItem::find_by_id($number);

		// Problem: Menu DB array not updated b/c don't access from DB array

		// not sure if this works b/c don't do find by id, when add Restaurant table should do a find id
		$item = $this->menuDBReg[$position];

		$item->incrementUpvote();
	}

	public function incrementDownVoteByItemNumber($position)
	{
		// menuItem's key should be the menu item
		// $this->menuItems[$number]->incrementDownvote();

		$item = $this->menuDBReg[$position];

		$item->incrementDownvote();
	}


	public function updatePositions()
	{
		$className = get_class($this->filterObject);
		if ($className == 'AlphaFilter' || $className =='PriceFilter')
		{
			// $this->filterObject->setOrderAscending($this->menuItems);
			// $this->filterObject->setOrderAscending($this->menuDBItems);
			// $this->filterObject->setOrderAscending($this->menuDB2Items);
			$this->filterObject->setOrderAscending($this->menuDBReg);
		}
		else
		{
			// $this->filterObject->setOrderDescending($this->menuItems);
			// $this->filterObject->setOrderDescending($this->menuDBItems);
			// $this->filterObject->setOrderDescending($this->menuDB2Items);
			$this->filterObject->setOrderDescending($this->menuDBReg);
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
		// echo json_encode($this->getAllItemsDetails());
		echo json_encode($this->getAllDBItemsDetails());
	}

	public function ajaxJSONRestEncode()
	{
		// echo json_encode($this->menuDB2Items);
		// foreach()
		// $toJSON = $this->createItemsJSON($this->menuDB2Items);
		$allItemsDetails = [];
		foreach($this->menuDBReg as $item)
		{
			$allItemsDetails[]=$item->getItemDetails();
		}
		echo json_encode($allItemsDetails);
	}

	public function createItemsJSON()
	{
		$allItemsDetails = [];
		foreach($this->menuDB2Items as $key => $value)
		{
			// $allItemsDetails[$key]->$value;
			$allItemsDetails[$key] = $value->getItemDetails();
		}
		return $allItemsDetails;
	}

	public function getAllDBItemsDetails()
	{
		$allItemsDetails = [];
		// foreach($this->menuDB2Items as $item)
		foreach($this->menuDBReg as $item)
		{
			$allItemsDetails[] = $item->getItemDetails();
		}
		// echo json_encode($allItemsDetails);
		return $allItemsDetails;
	}	

}

?>
