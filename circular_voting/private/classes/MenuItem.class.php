<?php

class MenuItem {
	private $itemNumber;
	private $itemName;

	private $upVoteNumber = 0;
	private $downVoteNumber = 0;

	// TODO: constructor to pass itemnumber, so getHTML as no parameters
	function __construct($args=[])
	{
    $this->itemNumber = $args['itemNumber'] ?? '';
    $this->itemName = $args['itemName'] ?? '';
	}


	public function printHTML()
	{
		$displayCode = "<section id = 'menu-item-{$this->itemNumber}' class = 'menu-item'>";
		$displayCode .= "<i class='fas fa-thumbs-down'></i>";
		$displayCode .= "<div class = 'plate'>";
		$displayCode .= "<img src = 'https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg' class = 'item-image'>";
		$displayCode .= "<div class = 'alpha-bg'>";
		// $displayCode .= "<p>Chickpeas</p>";
		$displayCode .= "<p>" . $this->itemName . "</p>";
		$displayCode .= "</div>";
		$displayCode .= "</div>";
		$displayCode .= "<i class='fas fa-thumbs-up'></i>";
		$displayCode .= "</section>";
		echo $displayCode;
	}
}
?>
