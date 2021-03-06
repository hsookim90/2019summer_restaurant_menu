<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/navHeader.php');
?>

<div class="content">
    <div id="restaurantList">
        <h3>Restaurants</h3>
        <script src=<?php echo url_for('js/home.js')?>></script>
        <div>
            <input type="text" id="addrInput" placeholder="Enter your address">
            <input type="button" value="Submit" onclick="startGeocoding(document.getElementById('addrInput').value)"/>
        </div>
        <div id="listContents"></div>
    </div>
</body>

<?php include(SHARED_PATH . '/footer.php');?>
