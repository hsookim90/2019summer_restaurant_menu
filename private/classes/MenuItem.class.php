<?php

class MenuItem {
	private $itemNumber;
	private $itemName;
	private $price;
	private $imageLink;
	private $thumbsUp;
	private $thumbsDown;


	private $upVoteNumber = 0;
	private $downVoteNumber = 0;

	// menu itemNumber is meaningless when not created by restaurant instance
	// but still able to make menu item without restaurant
	function __construct($args=[])
	{
    $this->itemNumber = $args['itemCount'] ?? 0;
    $this->itemName = $args['itemName'] ?? '';
		$this->price = $args['price'] ?? 0;
		$this->upVoteNumber = $args['upVoteNumber'] ?? 0;
		$this->downVoteNumber = $args['downVoteNumber'] ?? 0;
	}

	public function getItemDetails()
	{
		// might need to do h($this->itemName), but that might make the price a int to a string
		return ['itemName'=>$this->itemName, 'price'=>$this->price, 'upVoteNumber'=>$this->upVoteNumber,
						'downVoteNumber'=>$this->downVoteNumber, 'itemNumber'=>$this->itemNumber];
	}

	// created to test if can compare private var of another instance of same class
	public function compareItem($comparedItem)
	{
		$comparison = $this->price == $comparedItem->price;
	}

	public function hasMoreUpvotes($comparedItem)
	{
		return $this->upVoteNumber > $comparedItem->upVoteNumber;
	}

	// created b/c complications with hasMoreUpvotes with duplicates in list
	public function hasLessUpvotes($comparedItem)
	{
		return $this->upVoteNumber < $comparedItem->upVoteNumber;
	}

	public function hasMoreDownvotes($comparedItem)
	{
		return $this->downVoteNumber > $comparedItem->downVoteNumber;
	}

	// created b/c complications with hasMoreUpvotes with duplicates in list
	public function hasLessDownvotes($comparedItem)
	{
		return $this->downVoteNumber < $comparedItem->downVoteNumber;
	}

	public function incrementUpvote()
	{
		$this->upVoteNumber++;
	}

	public function incrementDownvote()
	{
		$this->downVoteNumber++;
	}

	public function compareNames($comparedItem)
	{
		return strcasecmp($this->itemName, $comparedItem->itemName);
	}
}
?>
