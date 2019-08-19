
<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($item)) {
  redirect_to(url_for('/index.php'));
}
?>

<dl>
  <dt>Name</dt>
  <dd><input type="text" name="item[itemName]" value="" /></dd>
</dl>

<dl>
  <dt>Price</dt>
  <dd><input type="text" name="item[price]" value="" /></dd>
</dl>

<dl>
  <dt>Image URL</dt>
  <dd><input type="text" name="item[image]" value="" /></dd>
</dl>

<?php if (isset($restID) ) {?>
  <input type="number" style="display:none" name = "restID" value = <?php echo $restID?> />
<?php }?>