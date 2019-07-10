<?php require_once('../../private/initialize.php');?>

<!DOCTYPE html>
<html lang="en">
<?php require 'head.php';?>

<body>
    <?php require 'header.php';?>
    
    <div class="content">
        <h3>Near Me</h3>
        <div id="map_nearme"></div>
    </div>

    <!-- TODO: this script should be in home.js but that happens, it does not work. probably scope issue -->
    <script>
        window.onscroll = function() {myFunction()};

        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
    </script>

    <?php require 'footer.php';?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8&libraries=places&callback=initMap"></script>
</body>
</html>
