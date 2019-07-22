
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

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [2=>$menuItem2, 1=>$menuItem1, 3=>$menuItem3, 4=>$menuItem4];
      $expectedFalseArray = [2=>$menuItem2, 3=>$menuItem3, 1=>$menuItem1, 4=>$menuItem4];
      self::$priceFilter->setOrderDescending($testArray);

      // same ensures order of elements is correct, assertEquals won't work
      $this->assertSame($expectedArray, $testArray, "Descending Assert Duplicates");

      // shows order should be 2,1,3,4 not 2,3,1,4 even though 1 and 3 have the same upvote number
      // before the sort whatever was ahead and equal value should still be ahead post sort
      $this->assertFalse($expectedFalseArray===$testArray, "Descending False Array Assert Duplicates");

      // Ascending

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [4=>$menuItem4, 1=>$menuItem1, 3=>$menuItem3, 2=>$menuItem2];
      $expectedFalseArray = [4=>$menuItem4, 3=>$menuItem3, 1=>$menuItem1, 2=>$menuItem2];
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

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];

      self::$priceFilter->setOrderDescending($testArray);

      $this->assertSame($expectedArray, $testArray, "Descending Assert Correct Order");

      // Ascending

      $testArray = [4=>$menuItem4, 3=>$menuItem3, 2=>$menuItem2, 1=>$menuItem1];
      $expectedArray = [4=>$menuItem4, 3=>$menuItem3, 2=>$menuItem2, 1=>$menuItem1];

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

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [2=>$menuItem2, 4=>$menuItem4, 3=>$menuItem3, 1=>$menuItem1];
      self::$priceFilter->setOrderDescending($testArray);

      $this->assertSame($expectedArray, $testArray, "Descending Assert Generic");

      // Ascending

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [1=>$menuItem1, 3=>$menuItem3, 4=>$menuItem4, 2=>$menuItem2];
      self::$priceFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert Generic");
  }
}
