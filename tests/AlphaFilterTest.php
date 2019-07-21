
<?php
require 'vendor/autoload.php';
require_once('private/initialize.php');

use PHPUnit\Framework\TestCase;

class AlphaFilterTest extends TestCase
{

  public static $alphaFilter;

  // not sure y but u need the void: https://thephp.cc/news/2019/02/help-my-tests-stopped-working
  public static function setUpBeforeClass() : void
  {
    self::$alphaFilter = new AlphaFilter();
  }

  public function testOrderDuplicates()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'itemName'=>'Duck']);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'itemName'=>'Toast']);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'itemName'=>'Duck']);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'itemName'=>'Chicken']);

      // Descending

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [2=>$menuItem2, 1=>$menuItem1, 3=>$menuItem3, 4=>$menuItem4];
      $expectedFalseArray = [2=>$menuItem2, 3=>$menuItem3, 1=>$menuItem1, 4=>$menuItem4];
      self::$alphaFilter->setOrderDescending($testArray);

      // same ensures order of elements is correct, assertEquals won't work
      $this->assertSame($expectedArray, $testArray, "Descending Assert");

      // shows order should be 2,1,3,4 not 2,3,1,4 even though 1 and 3 have the same name
      // before the sort whatever was ahead and equal value should still be ahead post sort
      $this->assertFalse($expectedFalseArray===$testArray, "Descending False Array Assert");

      // Ascending

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [4=>$menuItem4, 1=>$menuItem1, 3=>$menuItem3, 2=>$menuItem2];
      $expectedFalseArray = [4=>$menuItem4, 3=>$menuItem3, 1=>$menuItem1, 2=>$menuItem2];
      self::$alphaFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert");

      $this->assertFalse($expectedFalseArray===$testArray, "Ascending False Array Assert");
  }

  public function testCorrectOrder()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'itemName'=>'Duck']);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'itemName'=>'Chicken']);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'itemName'=>'Broccoli']);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'itemName'=>'Apricot Cake']);

      // Descending

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];

      self::$alphaFilter->setOrderDescending($testArray);

      $this->assertSame($expectedArray, $testArray, "Descending Assert");

      // Ascending

      $testArray = [4=>$menuItem4, 3=>$menuItem3, 2=>$menuItem2, 1=>$menuItem1];
      $expectedArray = [4=>$menuItem4, 3=>$menuItem3, 2=>$menuItem2, 1=>$menuItem1];

      self::$alphaFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert");
  }

  public function testEmptyArray()
  {
    $testArray = [];
    self::$alphaFilter->setOrderDescending($testArray);
    $this->assertSame([], $testArray, "Descending Assert");

    $testArray = [];
    self::$alphaFilter->setOrderAscending($testArray);
    $this->assertSame([], $testArray, "Ascending Assert");
  }

  public function testOrderGeneric()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'itemName'=>'Duck']);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'itemName'=>'Pork Chops']);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'itemName'=>'Green Beens']);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'itemName'=>'Horse']);

      // Descending

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [2=>$menuItem2, 4=>$menuItem4, 3=>$menuItem3, 1=>$menuItem1];
      self::$alphaFilter->setOrderDescending($testArray);

      $this->assertSame($expectedArray, $testArray, "Descending Assert");

      // Ascending

      $testArray = [1=>$menuItem1, 2=>$menuItem2, 3=>$menuItem3, 4=>$menuItem4];
      $expectedArray = [1=>$menuItem1, 3=>$menuItem3, 4=>$menuItem4, 2=>$menuItem2];
      self::$alphaFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert");
  }

  public function testCaseInsensitive()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'itemName'=>'apple']);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'itemName'=>'duck']);
      $testArray = [1=>$menuItem1, 2=>$menuItem2];
      $expectedArray = [2=>$menuItem2, 1=>$menuItem1];

      self::$alphaFilter->setOrderDescending($testArray);
      $this->assertSame($expectedArray, $testArray, "Both Lower");


      // in php lower case is greater than upper case
      $menuItem1 = new MenuItem(['itemCount' => 1, 'itemName'=>'apple']);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'itemName'=>'Duck']);
      $testArray = [1=>$menuItem1, 2=>$menuItem2];
      $expectedArray = [2=>$menuItem2, 1=>$menuItem1];

      self::$alphaFilter->setOrderDescending($testArray);
      $this->assertSame($expectedArray, $testArray, "Diff Case");
  }
}
