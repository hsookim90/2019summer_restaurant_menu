<?php require_once('../../private/initialize.php'); ?>

<?php
// Find all bicycles;
$restaurants = Restaurant::find_all();
?>
<?php $page_title = 'Restaurants'; ?>

<div id="content">
  <div class="Restaurant listing">
    <h1>Restaurants</h1>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/restaurant/new.php'); ?>">Add Restaurant</a>
    </div>

  	<table class="list">
      <tr>
        <th>Name</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($restaurants as $restaurant) { ?>
        <tr>
          <td><?php echo h($restaurant->getName()); ?></td>
          <td><a class="action" href="<?php echo url_for('/restaurant/delete.php?id=' . h(u($restaurant->getID()))); ?>">Delete</a></td>
        </tr>
      <?php } ?>
  	</table>

  </div>

</div>