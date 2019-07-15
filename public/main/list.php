<?php require_once('../../private/initialize.php');?>

<!DOCTYPE html>
<html lang="en">
<?php require 'head.php';?>

<body>
    <?php require 'header.php';?>
    
    <div class="content">
        <div id="restaurantList">
            <h3>Restaurants</h3>
            <script src=<?php echo url_for('js/home.js')?>></script>
            <div id="listContents"></div>
        </div>
    </div>

    <?php require 'footer.php';?>
</body>
</html>
