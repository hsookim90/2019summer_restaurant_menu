<meta charset="utf-8">
<title>Restaurant Menu</title>

<link rel="stylesheet" type="text/css" href=<?php echo url_for('css/menu.css');?>>
<link rel="stylesheet" type="text/css" href=<?php echo url_for('css/home.css')?>>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic SC">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src=<?php echo url_for("js/script.js");?> defer></script>
<script src=<?php echo url_for('js/home.js')?>></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href=<?php echo url_for('/main/list.php')?>>Restaurant List</a>
        <a href=<?php echo url_for('/main/nearme.php')?>>Near Me</a>
        <a href='#'>Favourite Restaurant</a>
        <a href=<?php echo url_for('/main/account.php')?>>Account Setting</a>
    </div>

    <div class="top-container">
        <a href="#" id="logo">
            <!-- TODO: design our logo -->
            <img src=<?php echo url_for('images/Food_and_Kitchen_Outline_Menu-512.png')?> alt="logo icon" style="width:42px;height:42px;border:0;">
        </a>
    </div>

    <div class="header" id="myHeader">
        <span id="openSidebar" onclick="openNav()">
            <img src=<?php echo url_for('images/Hamburger_icon.svg.png')?> alt="open icon" style="width:25px;height:30px;border:0;">
        </span>

        <span id="topSearchbar">
            <input type="text" placeholder="Search..." name="search">
            <button type="submit">Search</button>
        </span>

        <span id="filterIcon">
            <img src=<?php echo url_for('images/filter-512.png')?> alt="filter icon" style="width:25px;height:30px;border:0;" onclick="popupModal(event, 'filterModal')">
            <div id="filterModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal(event, 'filterModal')">&times;</span>
                    <h4 style="margin:auto">Filter</h4>

                    <div id="priceFilter">
                        <h6>Price</h6>
                        <button>$</button>
                        <button>$$</button>
                        <button>$$$</button>
                    </div>

                    <div id="genreFilter">
                        <h6>Genre</h6>
                        <!-- TODO: these should be replaced with circular icons -->
                        <button>Korean</button>
                        <button>Chinese</button>
                        <button>Italian</button>
                    </div>
                </div>
            </div>
        </span>
    </div>
</body>
