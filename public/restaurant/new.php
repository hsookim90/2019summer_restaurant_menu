<?php
    require_once('../../private/initialize.php');
    if(is_post_request()) {
        $args = $_POST['restaurant'];
        $restaurant = new Restaurant($args);
        $result = $restaurant->save();
        if($result===true)
        {
            echo "restaurant created sucessfully";
            redirect_to(url_for('/restaurant/index.php'));
        }
        else
        {
            echo "sql error";
        }
    }
    else
    {
        $restaurant = new Restaurant;
    }
?>

<html> 
    <body>
       <form action="<?php echo url_for('/restaurant/new.php'); ?>" method="post">
            <?php include('form_fields.php'); ?>
            <div id="operations">
                <input type="submit" value="Create Restaurant" />
            </div>
        </form>
    </body>
</html>