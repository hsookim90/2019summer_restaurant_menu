<?php require_once('../../private/initialize.php');?>

<!DOCTYPE html>
<html lang="en">
<?php require 'head.php';?>

<body>
    <?php require 'header.php';?>
    
    <div class="content">
        <div id="acc_info">
            <img src=<?php echo url_for('images/thumb__ser.png')?> alt="accoung img" style="width:100px;height:100px;border:0;">
            <p id="user_name">Name: </p>
            <p id="user_email">e-mail: </p>
            <p id="user_birthday">Date of Birth: </p>
            <p id="user_phone">Phone Nubmer: </p>
        </div>
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
</body>
</html>
