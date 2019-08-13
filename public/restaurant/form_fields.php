
<?php
// prevents this code from being loaded directly in the browser
// or without first setting the necessary object
if(!isset($restaurant)) {
  redirect_to(url_for('/index.php'));
}
?>

<dl>
  <dt>Name</dt>
  <dd><input type="text" name="restaurant[restName]" value="" /></dd>
</dl>

<dl>
  <dt>Address</dt>
  <dd><input type="text" name="restaurant[address]" value="" /></dd>
</dl>

<dl>
  <dt>Rating</dt>
  <dd><input type="text" name="restaurant[rating]" value="" /></dd>
</dl>

<dl>
  <dt>Price Level</dt>
  <dd><input type="number" name="restaurant[priceLevel]" min = "0" max = "4" value="" /></dd>
</dl>