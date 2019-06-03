<?php

interface iFilter
{
  // maybe these should be static functions
  // public function findNewPosition(&$array, $votedID, $fromIndex = 0, $toIndex = 0);
  public function findNewPosition(&$array, $votedID);
  public function updateItemsOrder(&$array);
}

?>
