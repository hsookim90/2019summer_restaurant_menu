
<?php
/*
Menu Item Voting Page

@Author Glenn <jayasugp@myumanitoba.ca>
*/

	require_once('../../private/initialize.php');
	session_start();

	// default filter is by upvote
    $filter = $_GET['filter']??"upvotes";
    $id = $_GET['id'] ?? 0;

	// if reset button clicked, clear restaurant in sessions var
	if(isset($_POST['resetRest']))
	{
		// TODO: add reset logic for now just does upvotes filter
	}

	include(SHARED_PATH . '/navHeader.php')
?>

<div class="actions">
	<a class="action" href="<?php echo url_for('/menu_item/new.php?id=' . h(u($id))); ?>">Add Item</a>
</div>

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
	$restaurant = Restaurant::find_by_id(1);
	$restaurant->setFilter($filter);
	$_SESSION['restaurant'] = $restaurant;
?>

<script type = "text/javascript">
	// script.js runs after this file and uses menuItemsDetails
	var menuItemsDetails = <?php echo json_encode($restaurant->getAllItemsDetails()); ?>;
</script>

</section>

<?php include(SHARED_PATH . '/footer.php');?>