<?php
	require_once('../private/initialize.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Menu Rating</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic SC">

    <link rel="stylesheet" type="text/css" href=<?php echo url_for('css/home.css')?>>
    <script src=<?php echo url_for('js/home.js')?>></script>
</head>

<body>
    <header style = "background-image: url(<?php echo url_for('images/dishes.jpg');?>)">
        <h2>Restaurant Menu</h2>
    </header>

    <section>
        <article>
            <div id="home_usr" class="tabcontent">
                <div class="searchbar">
                    <input type="text" placeholder="Search..." name="search">
                    <button type="submit">Search</button>
                </div>
            </div>

            <div id="home_nonusr" class="tabcontent">

            </div>

            <div id="restaurants" class="tabcontent">
                <h3>Restaurants</h3>
                <div clsss="container">
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
                </div>
            </div>

            <div id="near_me" class="tabcontent">
                <h3>Near Me</h3>
                <div id="map_near_me"></div>
            </div>
        </article>
    </section>

    <footer>
        <p>Glenn & Harrison</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!-- use it for google maps api key: AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8 -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8&libraries=places&callback=initMap"></script>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANSsJmxJqYNxohpoCaTgXuX0bIlrMrZu8&callback=initMap"></script>   -->
</body>
</html>
