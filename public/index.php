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
