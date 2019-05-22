<?php
require 'vendor/autoload.php';
require_once('private/initialize.php');

use PHPUnit\Framework\TestCase;

class RestaurantTest extends TestCase
{
    public function testItemsEqualsWithSameProperties()
    {
  		$item1 = new MenuItem(['itemCount'=>1, 'itemName'=>'rice', 'price'=>2]);
  		$item3 = new MenuItem(['itemCount'=>1, 'itemName'=>'rice', 'price'=>2]);
      // shows that 2 objects are considered equal if they have the same properties.
      $this->assertEquals($item1,$item3);
    }

}
?>
