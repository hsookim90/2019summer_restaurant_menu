<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/navHeader.php');
?>

<body>
    <div class="content">
        <div id="restaurantList">
            <h3>Restaurants</h3>
            <script src=<?php echo url_for('js/home.js')?>></script>
            <div id="listContents"></div>
        </div>
    </div>
</body>

<?php include(SHARED_PATH . '/footer.php');?>
