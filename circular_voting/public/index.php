<?php
	require_once('../private/initialize.php');
	session_start();
	if(!isset($_SESSION['restaurants'])) {$_SESSION['restaurants'] = []; }
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
	<?php

		// stub stuff will be replaced with database in future milestones
		$stubMenuItem1 = ['itemName'=>'chickpears', 'price'=>4];
		$stubMenuItem2 = ['itemName'=>'rice', 'price'=>2];
		$stubMenuItem3 = ['itemName'=>'bananas', 'price'=>3];

		$stubMenuItems = [$stubMenuItem1, $stubMenuItem2, $stubMenuItem3];

		// did not create with rating or hours, think of what to do for that later
		$stubRestaurantArgs = ['name' => 'Rockwood Urban Grill', 'address' => '50 Sage Creek Blvd',
		 				 'phoneNum' => '204-256-7625', 'website' =>'rockwoodgrill.ca',
						  'menuItems' => $stubMenuItems];

    $restaurant = new Restaurant($stubRestaurantArgs);
		$_SESSION['restaurants'] = [];
    $_SESSION['restaurants'][]=$restaurant;
    // $_SESSION['restaurants'][0]=$restaurant;

		// note createItem is public so can make item from outside Restaurant like so:
		// $restaurant->createItem(['itemName' => 'chicken']);

		$item1 = new MenuItem(['itemCount'=>1, 'itemName'=>'rice', 'price'=>2]);
		$item2 = new MenuItem(['itemCount'=>2, 'itemName'=>'rice', 'price'=>3]);
		$item1->compareItem($item2);
	?>

	</section>

  </body>
</html>
