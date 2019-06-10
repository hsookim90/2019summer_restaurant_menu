<?php

class Display{
  public static function printToScreen($string)
  {
      echo $string;
  }

  // problem upvotenumber is private to menu item?
  // why is upvote number private again?
  public function name($itemNumber, $itemName, $upVoteNumber)
  {
		$displayCode = "<section id = 'menu-item-" . h($this->itemNumber)  . "' class = 'menu-item'>";
		$displayCode .= "<i class='fas fa-thumbs-down'></i>";
		$displayCode .= "<div class = 'plate'>";
		$displayCode .= "<img src = 'https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg' class = 'item-image'>";
		$displayCode .= "<div class = 'alpha-bg'>";
		$displayCode .= "<p>" . h($this->itemName) . "</p>";
		$displayCode .= "</div>";
		$displayCode .= "</div>";
		$displayCode .= "<i class='fas fa-thumbs-up'></i>";
		$displayCode .= "<p class= 'upVotesID' >upvotes = " . h($this->upVoteNumber) . "</p>";
		$displayCode .= "<p class= 'downVotesID' >downvotes =3</p>";
		$displayCode .= "</section>";
  }
}

?>
