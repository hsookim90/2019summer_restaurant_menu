<?php

interface iFilter
{
  // maybe these should be static functions
  public function setOrderAscending(&$array);
  public function setOrderDescending(&$array);
}

?>
