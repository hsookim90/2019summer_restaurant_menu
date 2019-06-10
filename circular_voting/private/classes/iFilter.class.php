<?php

interface iFilter
{
  // maybe these should be static functions
  // public function findNewPosition(&$array, $votedID, $fromIndex = 0, $toIndex = 0);
  // public function updateItemsOrder(&$array);
  public function setOrderAscending(&$array);
  public function setOrderDescending(&$array);
}

?>
