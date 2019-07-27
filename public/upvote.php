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

    $rest = $_SESSION['restaurants'][0];
		// $menuItems = $rest->menuItems;

    $rest->incrementUpVoteByItemNumber($id);
		$rest->updatePositions();
		$rest->ajaxJSONEncode();
  }
  else {
    echo 'false';
  }

?>
