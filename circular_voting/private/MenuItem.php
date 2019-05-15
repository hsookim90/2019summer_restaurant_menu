<?php

class MenuItem {
	private $itemNumber;
	private $upVoteNumber = 0;
	private $downVoteNumber = 0;

	// TODO: constructor to pass itemnumber, so getHTML as no parameters
	
	public function getHtmlText($itemNumber)
	{
		$displayCode = "<section id = 'menu-item-{$itemNumber}' class = 'menu-item'>";
		$displayCode .= "<i class='fas fa-thumbs-down'></i>";
		$displayCode .= "<div class = 'plate'>";
		$displayCode .= "<img src = 'https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg' class = 'item-image'>";
		$displayCode .= "<div class = 'alpha-bg'>";
		// $displayCode .= "<p>Chickpeas</p>";
		$displayCode .= "<p>" . $name . "</p>";
		$displayCode .= "</div>";
		$displayCode .= "</div>";
		$displayCode .= "<i class='fas fa-thumbs-up'></i>";
		$displayCode .= "</section>";
		return $displayCode;
	}
?>