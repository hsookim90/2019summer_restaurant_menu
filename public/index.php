<?php
	require_once('../private/initialize.php');
	session_start();

	// default filter is by upvote
	$filter = $_GET['filter']??"upvotes";

	if(isset($_POST['resetRest']))
	{
		unset($_SESSION['restaurants']);
	}

	include(SHARED_PATH . '/navHeader.php')
?>

  <form class = 'categories-bar' action = "<?php echo url_for("/index.php"); ?>" method = "GET">
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
	$menuItems = MenuItem::find_all();

	$stubRestaurantArgs = ['name' => 'Rockwood Urban Grill', 'address' => '50 Sage Creek Blvd',
	 				 'phoneNum' => '204-256-7625', 'website' =>'rockwoodgrill.ca',
					  'menuItems'=>$menuItems];

	$restaurant = new Restaurant($stubRestaurantArgs);

	if(isset($_SESSION['restaurants'])===false)
	{
		$_SESSION['restaurants'][]=$restaurant;
	}
	$_SESSION['restaurants'][0]->setFilter($filter);
?>

<script type = "text/javascript">
	var menuItemsDetails = <?php echo json_encode($_SESSION['restaurants'][0]->getAllItemsDetails()); ?>;
</script>

</section>

<?php include(SHARED_PATH . '/footer.php');?>
