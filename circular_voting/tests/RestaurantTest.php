<?php
require 'vendor/autoload.php';
require_once('private/initialize.php');

use PHPUnit\Framework\TestCase;

class RestaurantTest extends TestCase
{
    // public function testIsOrderDescendingTrueDuplicates()
    // {
  	// 	$stubMenuItem1 = ['upVoteNumber'=>4];
  	// 	$stubMenuItem2 = ['upVoteNumber'=>3];
  	// 	$stubMenuItem3 = ['upVoteNumber'=>3];
  	// 	$stubMenuItem4 = ['upVoteNumber'=>1];
    //
    //   $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4]);
    //
    //   $this->assertTrue($restaurant->isOrderDescending());
    // }


    // public function testIsOrderDescendingFalse()
    // {
  	// 	$stubMenuItem1 = ['upVoteNumber'=>3];
  	// 	$stubMenuItem2 = ['upVoteNumber'=>4];
  	// 	$stubMenuItem3 = ['upVoteNumber'=>1];
    //   $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3]);
    //
    //   $this->assertFalse($restaurant->isOrderDescending());
    // }

    // public function testIsOrderDescendingFalseDuplicates()
    // {
  	// 	$stubMenuItem1 = ['upVoteNumber'=>4];
  	// 	$stubMenuItem2 = ['upVoteNumber'=>3];
  	// 	$stubMenuItem3 = ['upVoteNumber'=>3];
  	// 	$stubMenuItem4 = ['upVoteNumber'=>4];
    //
    //   $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4]);
    //
    //   $this->assertFalse($restaurant->isOrderDescending());
    // }

    public function testOrderDuplicates()
    {
    		$stubMenuItem1 = ['upVoteNumber'=>4];
    		$stubMenuItem2 = ['upVoteNumber'=>3];
    		$stubMenuItem3 = ['upVoteNumber'=>3];
    		$stubMenuItem4 = ['upVoteNumber'=>4];

        $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4]);

        $this->assertEquals([1,4,2,3], $restaurant->getMenuIDs());
    }

    private function generateRestaurant($stubMenuItems=[])
    {
  		$stubRestaurantArgs = ['name' => 'Rockwood Urban Grill', 'address' => '50 Sage Creek Blvd',
  		 				 'phoneNum' => '204-256-7625', 'website' =>'rockwoodgrill.ca',
  						  'menuItems' => $stubMenuItems];
      return new Restaurant($stubRestaurantArgs);
    }

    public function testMakeOrderDescending()
    {
  		$stubMenuItem1 = ['upVoteNumber'=>3];
  		$stubMenuItem2 = ['upVoteNumber'=>4];
  		$stubMenuItem3 = ['upVoteNumber'=>1];
  		$stubMenuItem4 = ['upVoteNumber'=>5];
  		$stubMenuItem5 = ['upVoteNumber'=>4];
      $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4, $stubMenuItem5]);
      $this->assertFalse($restaurant->isOrderDescending());
      $restaurant->makeOrderDescending();
      $this->assertTrue($restaurant->isOrderDescending());
  		$stubMenuItem1 = ['upVoteNumber'=>3];
  		$stubMenuItem2 = ['upVoteNumber'=>3];
  		$stubMenuItem3 = ['upVoteNumber'=>3];
  		$stubMenuItem4 = ['upVoteNumber'=>3];
  		$stubMenuItem5 = ['upVoteNumber'=>3];
      $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4, $stubMenuItem5]);
      $this->assertTrue($restaurant->isOrderDescending());
      $restaurant->makeOrderDescending();
      $this->assertTrue($restaurant->isOrderDescending());
  		$stubMenuItem1 = ['upVoteNumber'=>5];
  		$stubMenuItem2 = ['upVoteNumber'=>4];
  		$stubMenuItem3 = ['upVoteNumber'=>3];
  		$stubMenuItem4 = ['upVoteNumber'=>2];
  		$stubMenuItem5 = ['upVoteNumber'=>1];
      $restaurant->makeOrderDescending();
      $this->assertTrue($restaurant->isOrderDescending());
    }

    public function testUpdatePositions()
    {
  		$stubMenuItem1 = ['upVoteNumber'=>3];
  		$stubMenuItem2 = ['upVoteNumber'=>4];
  		$stubMenuItem3 = ['upVoteNumber'=>1];
  		$stubMenuItem4 = ['upVoteNumber'=>5];
  		$stubMenuItem5 = ['upVoteNumber'=>4];
      $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4, $stubMenuItem5]);

      $this->assertEquals(4,$restaurant->updatePositions(3, 3));
      $this->assertEquals(3,$restaurant->updatePositions(1, 4));
      // $this->assertEquals(1,$restaurant->updatePositions(2, 2, 0));
      $this->assertEquals(1,$restaurant->updatePositions(1, 4));
      $this->assertEquals(0,$restaurant->updatePositions(1, 4));
      // $restaurant->updatePositions(1,1,0);
    }

    public function testMoveElement()
    {
  		$stubMenuItem1 = ['upVoteNumber'=>5];
  		$stubMenuItem2 = ['upVoteNumber'=>3];
  		$stubMenuItem3 = ['upVoteNumber'=>3];
  		$stubMenuItem4 = ['upVoteNumber'=>3];
  		$stubMenuItem5 = ['upVoteNumber'=>1];
      $restaurant = $this->generateRestaurant([$stubMenuItem1, $stubMenuItem2, $stubMenuItem3, $stubMenuItem4, $stubMenuItem5]);

      // $restaurant->moveElement(3);

      $arr = [1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f', 7=>'g', 8=>'h'];


      $restaurant->moveElement($arr, 5, 2);

      $arr = [1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f', 7=>'g', 8=>'h'];
      $restaurant->moveElement($arr, 2, 5);

      $restaurant->moveElement($arr, 2, 2);

    }
}
?>
