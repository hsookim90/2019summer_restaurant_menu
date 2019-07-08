<?php require_once('../../private/initialize.php');?>

<!DOCTYPE html>
<html lang="en">
<?php require 'head.php';?>

<body>
    <?php require 'header.php';?>
    <script src=<?php echo url_for('js/restaurant_location.js')?>></script>
    
    <div class="content">
        <div id="rest_info">
            <img src=<?php echo url_for('images/3w3Blx0v.jpg')?> alt="burgerking logo" style="width:100px;height:100px;border:0;">
            <h3>Burger King</h3>
            <p>Phone: xxx-xxx-xxxx</p>
            <p>Address: Pembina Hwy</p>
            <div id="restaurant_location"></div>
        </div>

        <div id="review">
            <span id="ratingStar">
                <h3>Rating</h3>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
            </span>
            <span id="reviewFromUser"></span>
        </div>

        <a href="#" target="_blank">See Menu</a>
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
