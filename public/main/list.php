<?php
require_once('../../private/initialize.php');
include(SHARED_PATH . '/navHeader.php');
?>

<div class="content">
    <div id="restaurantList">
        <h3>Restaurants</h3>
        <script src=<?php echo url_for('js/home.js')?>></script>
        <div>
            <!-- https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp -->
            <input type="text" name = "addrKeyword" id="addrInput" placeholder="Enter your address">
            <input type="button" value="Submit" onclick="startGeocoding(document.getElementById('addrInput').value)"/>
        </div>
        <div id="listContents"></div>
    </div>
</body>

<?php include(SHARED_PATH . '/footer.php');?>
