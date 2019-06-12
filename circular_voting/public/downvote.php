<?php
  // You can simulate a slow server with sleep
  // sleep(2);

	require_once('../private/initialize.php');
	session_start();
	if(!isset($_SESSION['restaurants'])) {$_SESSION['restaurants'] = []; }

  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  if(!is_ajax_request()) { exit; }


  $raw_id = $_POST['id'] ?? '';

  if(preg_match("/menu-item-(\d+)/", $raw_id, $matches))
  {
    $id = $matches[1];

    // TODO change from always echo eio_true
    // probably will need to return back updated menu item number
    // may even need to figure out a way to return the whole list of items
    // might be able to only need to item top and below assuming can only give 1 vote
    echo 'true';
    $rest = $_SESSION['restaurants'][0];
		// $menuItems = $rest->menuItems;
		// $rest->printMenu();

		$rest->incrementDownVoteByItemNumber($id);
		$rest->updatePositions();
		echo 'start of br <br><br><br><br>';
		$rest->printMenu();
  }
  else {
    echo 'false';
  }

?>
