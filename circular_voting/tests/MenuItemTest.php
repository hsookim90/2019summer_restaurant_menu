<?php
require 'vendor/autoload.php';
require_once('private/initialize.php');

use PHPUnit\Framework\TestCase;

class MenuItemTest extends TestCase
{
    public function testItemsEqualsWithSameProperties()
    {
  		$item1 = new MenuItem(['itemCount'=>1, 'itemName'=>'rice', 'price'=>2]);
  		$item3 = new MenuItem(['itemCount'=>1, 'itemName'=>'rice', 'price'=>2]);
      // shows that 2 objects are considered equal if they have the same properties.
      $this->assertEquals($item1,$item3);
    }

    public function testHasMoreUpvotes()
    {
  		$item1 = new MenuItem(['itemCount'=>1, 'itemName'=>'rice', 'upVoteNumber'=>4]);
  		$item3 = new MenuItem(['itemCount'=>2, 'itemName'=>'potatos', 'upVoteNumber'=>5]);
  		$item4 = new MenuItem(['itemCount'=>8, 'itemName'=>'grapes', 'upVoteNumber'=>5]);

      $this->assertTrue($item3->hasMoreUpvotes($item1));
      $this->assertFalse($item3->hasMoreUpvotes($item4));
    }


}
?>
