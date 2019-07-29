<?php

class Restaurant {
	private $name;
	private $address;
	private $phoneNum;
	private $website;
	private $rating;
	private $hours;
	private static $restaurantCount = 0;
	private $restaurantID;
	private $filterObject;
	private $menuItems = [];

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

		if (isset($args['menuItems']))
		{
			$this->menuItems = $args['menuItems'];
		}
	}

	public function incrementUpVoteByItemNumber($position)
	{
		// Note: We rely that the item in the array has a id var that corresponds to the DB.
		// We may have to do a find_by_id search in the future instead, for now this works.
		$item = $this->menuItems[$position];
		$item->incrementUpvote();
	}

	public function incrementDownVoteByItemNumber($position)
	{
		$item = $this->menuItems[$position];
		$item->incrementDownvote();
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
		// call updatePositions b/c after u click a filter u expect the positions to change
		$this->updatePositions();
	}

	// json encode reference: https://www.dyn-web.com/tutorials/php-js/json/multidim-arrays.php
	public function ajaxJSONRestEncode()
	{
		echo json_encode($this->getAllItemsDetails());
	}

	public function getAllItemsDetails()
	{
		$allItemsDetails = [];
		foreach($this->menuItems as $item)
		{
			$allItemsDetails[] = $item->getItemDetails();
		}
		return $allItemsDetails;
	}	
}
?>
