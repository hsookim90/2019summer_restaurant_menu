<?php
	require_once('../../private/initialize.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php require 'head.php';?>

<body>
    <?php require 'header.php';?>
    
    <section>
        <article>

            <div id="restaurantList">
                <h3>Restaurants</h3>
                <!-- <div clsss="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="gallery">
                                <img src=<?php echo url_for('images/1200px-McDonald\'s_Golden_Arches.svg.png');?> alt="mcdonalds logo" width="600" height="400">
                                <div class="desc">
                                    <button class="menuDetailBtn" onclick="popupModal(event, 'mcdonalds_modal')">McDonalds</Button>

                                    <div id="mcdonalds_modal" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal(event, 'mcdonalds_modal')">&times;</span>
                                            <p>McDonald's is an American fast food company, founded in 1940 as a restaurant operated by Richard and Maurice McDonald, in San Bernardino, California, United States.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="gallery">
                                <img src="<?php echo url_for('images/3w3Blx0v.jpg');?>" alt="burgerking logo" width="600" height="400">
                                <div class="desc">
                                    <button class="menuDetailBtn" onclick="popupModal(event, 'burgerking_modal')">Burger King</Button>

                                    <div id="burgerking_modal" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal(event, 'burgerking_modal')">&times;</span>
                                            <p>Burger King is an American global chain of hamburger fast food restaurants. Headquartered in the unincorporated area of Miami-Dade County, Florida, the company was founded in 1953 as Insta-Burger King, a Jacksonville, Florida–based restaurant chain.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <button>get json data</button>

            </div>
        </article>
    </section>

    <?php require 'footer.php';?>
</body>
</html>
