
<?php

require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/restaurant/index.php'));
}
$id = $_GET['id'];
$restaurant = Restaurant::find_by_id($id);
if($restaurant == false)
{
  redirect_to(url_for('/restaurant/index.php'));
}

if(is_post_request()) {

  $result = $restaurant->delete();
  redirect_to(url_for('/restaurant/index.php'));

} else {
  // Display form
}

?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/restaurant/index.php'); ?>">&laquo; Back to List</a>

  <div class="restaurant delete">
    <h1>Delete Restaurant</h1>
    <p>Are you sure you want to delete this restaurant?</p>
    <p class="item"><?php echo h($restaurant->getName()); ?></p>

    <form action="<?php echo url_for('/restaurant/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Restaurant" />
      </div>
    </form>
  </div>

</div>