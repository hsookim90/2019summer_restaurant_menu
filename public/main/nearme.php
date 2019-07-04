<?php
	require_once('../../private/initialize.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php require 'head.php';?>

<body>
    <?php require 'header.php';?>

    <section>
        <article>
            <h3>Near Me</h3>
            <div id="map_nearme"></div>
        </article>
    </section>

    <?php require 'footer.php';?>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8&libraries=places&callback=initMap"></script>
</body>
</html>
