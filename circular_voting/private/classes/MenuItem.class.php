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
	}


	public function printHTML()
	{
		// for reference, what the html looks like:
		// here for future reference if need to change html/css
		// TODO delete this before production

	  // <section class = "menu-item">
		// <i class="fas fa-thumbs-down"></i>
		//   <div class = "plate">
		// 	<img src = "https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg" class = "item-image">
		// 	<div class = 'alpha-bg'>
		// 		<p>Chickpeas</p>
		// 	</div>
		//   </div>
	  // 	<i class="fas fa-thumbs-up"></i>
	  // </section>

		// TODO have vars populate from the database

		// $displayCode .= "<section id = 'menu-item-{$this->itemNumber}' class = 'menu-item'>";

		$displayCode = "<section id = 'menu-item-" . h($this->itemNumber)  . "' class = 'menu-item'>";
		$displayCode .= "<p id= 'upVotesID' style = 'text-align:right'>upvotes = " . h($this->upVoteNumber) . "</p>";
		$displayCode .= "<p id= 'downVotesID' style = 'text-align:right'>downvotes =3</p>";
		$displayCode .= "<i class='fas fa-thumbs-down'></i>";
		$displayCode .= "<div class = 'plate'>";
		$displayCode .= "<img src = 'https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg' class = 'item-image'>";
		$displayCode .= "<div class = 'alpha-bg'>";
		$displayCode .= "<p>" . h($this->itemName) . "</p>";
		$displayCode .= "</div>";
		$displayCode .= "</div>";
		$displayCode .= "<i class='fas fa-thumbs-up'></i>";
		$displayCode .= "</section>";
		echo $displayCode;
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

	public function incrementUpvote()
	{
		$this->upVoteNumber++;
	}
}
?>
