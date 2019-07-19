<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/navHeader.php');
?>

<div class="content">
    <h3>Near Me</h3>
    <div id="map_nearme"></div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8&libraries=places&callback=initMap"></script>
<?php include(SHARED_PATH . '/footer.php');?>
