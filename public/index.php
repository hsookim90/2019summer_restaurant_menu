<?php
	require_once('../private/initialize.php');
	session_start();

	// if(!isset($_SESSION['restaurants'])) {$_SESSION['restaurants'] = []; }
	// default filter is by upvote
	$filter = $_GET['filter']??"upvotes";

	if(isset($_POST['resetRest']))
	{
		unset($_SESSION['restaurants']);
	}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Voting Idea</title>
  	<link rel="stylesheet" type="text/css" href="css/style.css">
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic SC">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    	<script src="js/script.js" defer></script>

  </head>
  <body>
      <form action = "<?php echo url_for("/index.php"); ?>" method = "GET">
        <section class = "filters-row">
				      <button type = "submit" name = "filter" class ="" value = "upvotes">Upvotes</button>
				      <button type = "submit" name = "filter" class ="" value = "downvotes">DownVotes</button>
				      <button type = "submit" name = "filter" class ="" value = "ratio">Ratio</button>
        </section>
			</form>
			<div>
      <form action = "<?php echo url_for("/index.php"); ?>" method = "POST">
				<button type = "submit" name = "resetRest" value = "Submit">Reset Resaurants</button>
			</form>
		</div>

	<section class = "menu-items-display">
	<?php

		// stub stuff will be replaced with database in future milestones
		$stubMenuItem1 = ['itemName'=>'chickpears', 'price'=>4];
		$stubMenuItem2 = ['itemName'=>'rice', 'price'=>2, 'downVoteNumber'=>1];
		// note upvotenumber = 1 for now, in production go back to 0 b/c no one voted for it
		$stubMenuItem3 = ['itemName'=>'bananas', 'price'=>3, 'upVoteNumber'=>1];

		$stubMenuItems = [$stubMenuItem1, $stubMenuItem2, $stubMenuItem3];

		// did not create with rating or hours, think of what to do for that later
		$stubRestaurantArgs = ['name' => 'Rockwood Urban Grill', 'address' => '50 Sage Creek Blvd',
		 				 'phoneNum' => '204-256-7625', 'website' =>'rockwoodgrill.ca',
						  'menuItems' => $stubMenuItems];

    $restaurant = new Restaurant($stubRestaurantArgs);
		// $restaurant->setFilter($filter);
		// $_SESSION['restaurants'] = [];
    // $_SESSION['restaurants'][]=$restaurant;

		if(isset($_SESSION['restaurants'])===false)
		{
    	$_SESSION['restaurants'][]=$restaurant;
		}
		$_SESSION['restaurants'][0]->setFilter($filter);
		$_SESSION['restaurants'][0]->printMenu();
		// $_SESSION['restaurants'][0]->getAllItemsDetails();

	?>

	<script type = "text/javascript">
		var menuItemsDetails = <?php echo json_encode($_SESSION['restaurants'][0]->getAllItemsDetails()); ?>;
		console.log('testing json encode in JS');
		console.log(menuItemsDetails);
		console.log("start of menu item names:");
		for (var i = 0; i < menuItemsDetails.length; i++)
		{
			console.log(menuItemsDetails[i].itemName);
			console.log('getting id num:');
			console.log(menuItemsDetails[i]);
			console.log(getItemHTMLString(menuItemsDetails[i]));

			// below 2 lines actually do work commenting out for now
      // var menuDisplay = document.querySelector(".menu-items-display");
      // menuDisplay.innerHTML = getItemHTMLString(menuItemsDetails[i]);
		}

		function getItemHTMLString(itemObj)
		{
				var displayCode = "<section id = 'menu-item-" + itemObj.itemNumber
				+ "' class = 'menu-item'>";
				displayCode += "<h1>" + itemObj.itemName + "</h1>";
				displayCode += "<div class = 'plate'>";
				displayCode += "<img src = 'https://lh5.ggpht.com/_OaYG005JPDs/TVr8btiAytI/AAAAAAAACuA/7aZpNQQxKbE/s640/Chana%20Masala%20above%20close.jpg' class = 'item-image'>";
				displayCode += "</div>";
				displayCode += "<p class='price-num'>$" + itemObj.price + "</p>";
				displayCode += "<i class='fas fa-thumbs-down'></i>";
				displayCode += "<i class='fas fa-thumbs-up'></i>";
				displayCode += "<div class='votes-bar'</div>";
				return displayCode;
		}
	</script>

	</section>

  </body>
</html>
