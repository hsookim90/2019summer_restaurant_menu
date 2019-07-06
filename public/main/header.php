<?php require_once('../../private/initialize.php');?>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href=<?php echo url_for('home.php')?>>Restaurant List</a>
    <a href=<?php echo url_for('nearme.php')?>>Near Me</a>
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
        <!-- <button onclick="popupModal(event, 'filterModal')">Filter</button> -->
        
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