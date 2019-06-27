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
    <header>
        <h2>Restaurant Menu</h2>
    </header>

    <section>
        <nav>
            <div class="scrolltab">
                <button class="tablinks" onclick="openTab(event, 'home_usr')" id="defaultOpen">Home</button>
                <button class="tablinks" onclick="openTab(event, 'trend')">Trend</button>
                <button class="tablinks" onclick="openTab(event, 'promotion')">Promotion</button>
                <button class="tablinks" onclick="openTab(event, 'near_me')">Near Me</button>
            </div>
        </nav>

        <article>
            <div id="home_usr" class="tabcontent">
                <div class="searchbar">
                    <input type="text" placeholder="Search..." name="search">
                    <button type="submit">Search</button>
                </div>

                <div id="map_main"></div>
            </div>

            <div id="home_nonusr" class="tabcontent">

            </div>

            <div id="trend" class="tabcontent">
                <h3>Trend</h3>
                <div clsss="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="gallery">
                                <img src=<?php echo url_for('images/bigmac.jpg');?> alt="BigMac" width="600" height="400">
                                <div class="desc">
                                    <button class="menuDetailBtn" onclick="popupModal(event, 'bigmac-Modal')">BigMac</Button>

                                    <div id="bigmac-Modal" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal(event, 'bigmac-Modal')">&times;</span>
                                            <p>blah blah</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="gallery">
                                <img src="<?php echo url_for('images/fries.jpg');?>" alt="BigMac" width="600" height="400">
                                <div class="desc">
                                    <button class="menuDetailBtn" onclick="popupModal(event, 'frenchfries-Modal')">French Fries</Button>

                                    <div id="frenchFries-Modal" class="modal">
                                        <div class="modal-content">
                                            <span class="close" onclick="closeModal(event, 'frenchfries-Modal')">&times;</span>
                                            <p>blah blah</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">

                        </div>
                    </div>
                </div>
            </div>

            <div id="promotion" class="tabcontent">
                <h3>Promotion</h3>
                <p>blah</p>
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
