<?php
    $restID = $_GET['id'] ?? 0;
    require_once('../../private/initialize.php');
    if(is_post_request()) {
        $args = $_POST['item'];
        $item = new MenuItem($args);
        $restID = $_POST['restID'] ?? 0;
        $result = $item->save();
        if($result===true)
        {
            echo "Menu Item created sucessfully";
            $item->updateItemRestaurantTable($restID);

            redirect_to(url_for('/restaurant/show.php?id=' . h(u($restID))));
        }
        else
        {
            echo "sql error";
        }
    }
    else
    {
        $item = new MenuItem;
    }
?>

<html> 
    <body>
       <form action="<?php echo url_for('/menu_item/new.php'); ?>" method="post">
            <?php include('form_fields.php'); ?>
            <div id="operations">
                <input type="submit" value="Create Menu Item" />
            </div>
        </form>
    </body>
</html>