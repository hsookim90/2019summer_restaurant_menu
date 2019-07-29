
<?php
require 'vendor/autoload.php';
require_once('private/initialize.php');

use PHPUnit\Framework\TestCase;

class PriceFilterTest extends TestCase
{

  public static $priceFilter;

  // not sure y but u need the void: https://thephp.cc/news/2019/02/help-my-tests-stopped-working
  public static function setUpBeforeClass() : void
  {
    self::$priceFilter = new PriceFilter();
  }

  public function testOrderDuplicates()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'price'=>2.23]);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'price'=>3.54]);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'price'=>2.23]);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'price'=>1.99]);

      // Descending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem2, $menuItem1, $menuItem3, $menuItem4];
      $expectedFalseArray = [$menuItem2, $menuItem3, $menuItem1, $menuItem4];
      self::$priceFilter->setOrderDescending($testArray);

      // same ensures order of elements is correct, assertEquals won't work
      $this->assertSame($expectedArray, $testArray, "Descending Assert Duplicates");

      // shows order should be 2,1,3,4 not 2,3,1,4 even though 1 and 3 have the same upvote number
      // before the sort whatever was ahead and equal value should still be ahead post sort
      $this->assertFalse($expectedFalseArray===$testArray, "Descending False Array Assert Duplicates");

      // Ascending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem4, $menuItem1, $menuItem3, $menuItem2];
      $expectedFalseArray = [$menuItem4, $menuItem3, $menuItem1, $menuItem2];
      self::$priceFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert");

      $this->assertFalse($expectedFalseArray===$testArray, "Ascending False Array Assert Duplicates");
  }
  //
  public function testCorrectOrder()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'price'=>10.32]);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'price'=>5.99]);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'price'=>3.12]);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'price'=>1.33]);

      // Descending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];

      self::$priceFilter->setOrderDescending($testArray);

      $this->assertSame($expectedArray, $testArray, "Descending Assert Correct Order");

      // Ascending

      $testArray = [$menuItem4, $menuItem3, $menuItem2, $menuItem1];
      $expectedArray = [$menuItem4, $menuItem3, $menuItem2, $menuItem1];

      self::$priceFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert Correct Order");
  }

  public function testEmptyArray()
  {
    $testArray = [];
    self::$priceFilter->setOrderDescending($testArray);
    $this->assertSame([], $testArray, "Descending Assert Empty Array");

    $testArray = [];
    self::$priceFilter->setOrderAscending($testArray);
    $this->assertSame([], $testArray, "Ascending Assert Empty Array");
  }

  public function testOrderGeneric()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'price'=>4.3]);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'price'=>50.34]);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'price'=>40.11]);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'price'=>40.34]);

      // Descending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem2, $menuItem4, $menuItem3, $menuItem1];
      self::$priceFilter->setOrderDescending($testArray);

      $this->assertSame($expectedArray, $testArray, "Descending Assert Generic");

      // Ascending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem1, $menuItem3, $menuItem4, $menuItem2];
      self::$priceFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert Generic");
  }
}
