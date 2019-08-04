<?php
/*
  Database connection handling.
	@author Glenn <jayasugp@myumanitoba.ca>
*/

function db_connect() {
  // constants from git ignore'd db_creditionals file
  $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect($connection);
  return $connection;
}

function confirm_db_connect($connection) {
  if($connection->connect_errno) {
    $msg = "Database connection failed: ";
    $msg .= $connection->connect_error;
    $msg .= " (" . $connection->connect_errno . ")";
    exit($msg);
  }
}

function db_disconnect($connection) {
  if(isset($connection)) {
    $connection->close();
  }
}
?>
