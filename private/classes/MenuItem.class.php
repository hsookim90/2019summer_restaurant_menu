<?php

class MenuItem extends DatabaseObject {

	static protected $table_name = 'menu_item';
	static protected $db_columns = ['id','itemNumber','itemName','price','image','upVoteNumber','downVoteNumber'];

	protected $id;
	protected $itemNumber;
	protected $itemName;
	public $price;
	protected $image;

	protected $upVoteNumber = 0;
	protected $downVoteNumber = 0;

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

	public function hasLessDownvotes($comparedItem)
	{
		return $this->downVoteNumber < $comparedItem->downVoteNumber;
	}

	public function incrementUpvote()
	{
		// Note: We rely that the item has a id var that corresponds to the DB.
		// We may have to do a find_by_id search in the future instead, for now this works.
		$this->upVoteNumber++;
		$this->save();
	}

	public function incrementDownvote()
	{
		$this->downVoteNumber++;
		$this->save();
	}

	public function compareNames($comparedItem)
	{
		return strcasecmp($this->itemName, $comparedItem->itemName);
	}

	public function comparePrice($comparedItem)
	{
			// return $this->price <=> $comparedItem->price;
			// above doesn't work b/c only does integers.

			$difference = $this->price - $comparedItem->price;
			if ($difference > 0)
			{
				return 1;
			}
			else if ($difference < 0)
			{
				return -1;
			}
			else {
				return 0;
			}
	}

}
?>
