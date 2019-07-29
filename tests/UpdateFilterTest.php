
<?php
require 'vendor/autoload.php';
require_once('private/initialize.php');

use PHPUnit\Framework\TestCase;

class UpdateFilterTest extends TestCase
{

  public static $upvotesFilter;

  // not sure y but u need the void: https://thephp.cc/news/2019/02/help-my-tests-stopped-working
  public static function setUpBeforeClass() : void
  {
    self::$upvotesFilter = new UpvotesFilter();
  }

  public function testOrderDuplicates()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'upVoteNumber'=>2]);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'upVoteNumber'=>3]);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'upVoteNumber'=>2]);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'upVoteNumber'=>1]);

      // Descending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem2, $menuItem1, $menuItem3, $menuItem4];
      $expectedFalseArray = [$menuItem2, $menuItem3, $menuItem1, $menuItem4];
      self::$upvotesFilter->setOrderDescending($testArray);

      // same ensures order of elements is correct, assertEquals won't work
      $this->assertSame($expectedArray, $testArray, "Descending Assert");

      // shows order should be 2,1,3,4 not 2,3,1,4 even though 1 and 3 have the same upvote number
      // before the sort whatever was ahead and equal value should still be ahead post sort
      $this->assertFalse($expectedFalseArray===$testArray, "Descending False Array Assert");

      // Ascending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem4, $menuItem1, $menuItem3, $menuItem2];
      $expectedFalseArray = [$menuItem4, $menuItem3, $menuItem1, $menuItem2];
      self::$upvotesFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert");

      // $this->assertFalse($expectedFalseArray===$testArray, "Ascending False Array Assert");
  }

  public function testCorrectOrder()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'upVoteNumber'=>10]);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'upVoteNumber'=>5]);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'upVoteNumber'=>3]);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'upVoteNumber'=>1]);

      // Descending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];

      self::$upvotesFilter->setOrderDescending($testArray);

      $this->assertSame($expectedArray, $testArray, "Descending Assert");

      // Ascending

      $testArray = [$menuItem4, $menuItem3, $menuItem2, $menuItem1];
      $expectedArray = [$menuItem4, $menuItem3, $menuItem2, $menuItem1];

      self::$upvotesFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert");
  }

  public function testEmptyArray()
  {
    $testArray = [];
    self::$upvotesFilter->setOrderDescending($testArray);
    $this->assertSame([], $testArray, "Descending Assert");

    $testArray = [];
    self::$upvotesFilter->setOrderAscending($testArray);
    $this->assertSame([], $testArray, "Ascending Assert");
  }

  public function testOrderGeneric()
  {
      $menuItem1 = new MenuItem(['itemCount' => 1, 'upVoteNumber'=>4]);
      $menuItem2 = new MenuItem(['itemCount' => 2, 'upVoteNumber'=>50]);
      $menuItem3 = new MenuItem(['itemCount' => 3, 'upVoteNumber'=>32]);
      $menuItem4 = new MenuItem(['itemCount' => 4, 'upVoteNumber'=>40]);

      // Descending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem2, $menuItem4, $menuItem3, $menuItem1];
      self::$upvotesFilter->setOrderDescending($testArray);

      $this->assertSame($expectedArray, $testArray, "Descending Assert");

      // Ascending

      $testArray = [$menuItem1, $menuItem2, $menuItem3, $menuItem4];
      $expectedArray = [$menuItem1, $menuItem3, $menuItem4, $menuItem2];
      self::$upvotesFilter->setOrderAscending($testArray);

      $this->assertSame($expectedArray, $testArray, "Ascending Assert");
  }
}
