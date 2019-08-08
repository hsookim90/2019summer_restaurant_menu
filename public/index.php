<?php
/*
Menu Item Voting Page

@Author Glenn <jayasugp@myumanitoba.ca>
*/

	require_once('../private/initialize.php');
	session_start();

	// default filter is by upvote
	$filter = $_GET['filter']??"upvotes";

	// if reset button clicked, clear restaurant in sessions var
	if(isset($_POST['resetRest']))
	{
		unset($_SESSION['restaurants']);
	}

	include(SHARED_PATH . '/navHeader.php')
?>

<form class = 'filters-bar' action = "<?php echo url_for("/index.php"); ?>" method = "GET">
	<section class = "filters-row">
			<button type = "submit" name = "filter" class ="" value = "upvotes">Upvotes</button>
			<button type = "submit" name = "filter" class ="" value = "downvotes">DownVotes</button>
			<button type = "submit" name = "filter" class ="" value = "alpha">Alpha</button>
			<button type = "submit" name = "filter" class ="" value = "price">Price</button>
	</section>
</form>

<div>
	<form action = "<?php echo url_for("/index.php"); ?>" method = "POST">
		<button type = "submit" name = "resetRest" value = "Submit">Reset Resaurants</button>
	</form>
</div>

<section class = "menu-items-display">

<?php
	// Get all menu items from menu_item table in DB
	$menuItems = MenuItem::find_all();

	$stubRestaurantArgs = ['restName' => 'Rockwood Urban Grill', 'address' => '50 Sage Creek Blvd',
					  'phoneNum' => '204-256-7625', 'website' =>'rockwoodgrill.ca',
					  'priceLevel' => 2, 'rating'=>4.2, 'menuItems'=>$menuItems];

	$restaurant = new Restaurant($stubRestaurantArgs);
	$dbRestaurant = Restaurant::find_by_id(1);

	if(isset($_SESSION['restaurants'])===false)
	{
		$_SESSION['restaurants'][]=$restaurant;
	}
	// Sesssion is array of arrays to support multiple restaurants if needed.
	$_SESSION['restaurants'][0]->setFilter($filter);
?>

<script type = "text/javascript">
	// script.js runs after this file and uses menuItemsDetails
	var menuItemsDetails = <?php echo json_encode($_SESSION['restaurants'][0]->getAllItemsDetails()); ?>;
</script>

</section>

<?php include(SHARED_PATH . '/footer.php');?>
