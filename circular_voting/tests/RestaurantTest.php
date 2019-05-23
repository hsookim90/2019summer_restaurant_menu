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

    // this shows how a regular expression works
    // we want to see if menu item x appears before menu item y
    // i don't know the regular expression to do that though
    public function testRegularExpression()
    {
      $this->expectOutputRegex('/menu-item-(\d+)/');

  		$stubMenuItem1 = ['itemName'=>'chickpears', 'price'=>4];
  		$stubMenuItem2 = ['itemName'=>'rice', 'price'=>2];
  		$stubMenuItem3 = ['itemName'=>'bananas', 'price'=>3];

  		$stubMenuItems = [$stubMenuItem1, $stubMenuItem2, $stubMenuItem3];

  		// did not create with rating or hours, think of what to do for that later
  		$stubRestaurantArgs = ['name' => 'Rockwood Urban Grill', 'address' => '50 Sage Creek Blvd',
  		 				 'phoneNum' => '204-256-7625', 'website' =>'rockwoodgrill.ca',
  						  'menuItems' => $stubMenuItems];

      $restaurant = new Restaurant($stubRestaurantArgs);
      // $this->expectOutputString('foo');
      $restaurant->printMenu();
    }

    public function testIsOrderDescendingTrue()
    {
  		$stubMenuItem1 = ['upVoteNumber'=>4];
  		$stubMenuItem2 = ['upVoteNumber'=>3];
  		$stubMenuItem3 = ['upVoteNumber'=>1];

      $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3]);

      $this->assertTrue($restaurant->isOrderDescending());

    }

    public function testIsOrderDescendingTrueDuplicates()
    {
  		$stubMenuItem1 = ['upVoteNumber'=>4];
  		$stubMenuItem2 = ['upVoteNumber'=>3];
  		$stubMenuItem3 = ['upVoteNumber'=>3];
  		$stubMenuItem4 = ['upVoteNumber'=>1];

      $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4]);

      $this->assertTrue($restaurant->isOrderDescending());

    }


    public function testIsOrderDescendingFalse()
    {
  		$stubMenuItem1 = ['upVoteNumber'=>3];
  		$stubMenuItem2 = ['upVoteNumber'=>4];
  		$stubMenuItem3 = ['upVoteNumber'=>1];
      $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3]);

      $this->assertFalse($restaurant->isOrderDescending());
    }

    public function testIsOrderDescendingFalseDuplicates()
    {
  		$stubMenuItem1 = ['upVoteNumber'=>4];
  		$stubMenuItem2 = ['upVoteNumber'=>3];
  		$stubMenuItem3 = ['upVoteNumber'=>3];
  		$stubMenuItem4 = ['upVoteNumber'=>4];

      $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4]);

      $this->assertFalse($restaurant->isOrderDescending());
    }

    private function generateRestaurant($stubMenuItems=[])
    {
  		$stubRestaurantArgs = ['name' => 'Rockwood Urban Grill', 'address' => '50 Sage Creek Blvd',
  		 				 'phoneNum' => '204-256-7625', 'website' =>'rockwoodgrill.ca',
  						  'menuItems' => $stubMenuItems];
      return new Restaurant($stubRestaurantArgs);
    }

}
?>
