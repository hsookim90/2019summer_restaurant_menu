<?php require_once('../../private/initialize.php');?>

<!DOCTYPE html>
<html lang="en">
<?php require 'head.php';?>

<body>
    <?php require 'header.php';?>
    <script src=<?php echo url_for('js/restaurant_location.js')?>></script>
    
    <div class="content">
        <div id="rest_info">
            <h3><?php echo $restName = $_GET['restName'];?></h3><br>
            <img src="https://maps.googleapis.com/maps/api/place/photo?photoreference=<?php echo $_GET['photo_ref'];?>&sensor=false&maxheight=200&maxwidth=200&key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8" alt="restaurant image">
            <p><?php echo $address = $_GET['address'];?></p>
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
        </div><br>
        <div id="restaurant_location"></div><br>
        <a href="#">See Menu</a>
    </div>

    <?php require 'footer.php';?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8&libraries=places&callback=initMap"></script>
</body>
</html>
