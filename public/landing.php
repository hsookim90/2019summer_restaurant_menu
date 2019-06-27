<?php
	require_once('../private/initialize.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome to Foodie's menu</title>

	<link rel="stylesheet" type="text/css"
href=<?php echo url_for('css/landingPage.css')?>>
<script src="index_script.js"></script>
    </head>

    <body style = "background-image: url(<?php echo url_for('images/index_background.jpg');?>)">
        <!-- https://www.youtube.com/watch?v=AftND9WHhr4 -->
        <div class="blurredBox">
            <h2>Welcome to Foodie's menu</h2>
            <form action="">
                <p>Email</p>
                <input type="email" placeholder="Enter Email">
                <p>Password</p>
                <input type="password" placeholder="Enter Password">
                <input type="submit" value="Sign In">
                <p><input type="checkbox">Remember Me</p>
            </form>
        </div>
    </body>
</html>
