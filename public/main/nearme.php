<?php
	require_once('../../private/initialize.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php require 'head';?>

<body>
    <?php require 'header.php';?>

    <section>
        <article>
            <div id="near_me" class="tabcontent">
                <h3>Near Me</h3>
                <div id="map_near_me"></div>
            </div>
        </article>
    </section>

    <?php require 'footer.php';?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!-- use it for google maps api key: AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8 -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8&libraries=places&callback=initMap"></script>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8&callback=initMap"></script>   -->
</body>
</html>
