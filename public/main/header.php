<?php
	require_once('../../private/initialize.php');
?>
<header>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href=<?php echo url_for('home.php')?>>Restaurant List</a>
        <a href=<?php echo url_for('nearme.php')?>>Near Me</a>
    </div>

    <div id="header">
        <a href="#" id="logo">Logo</a>

        <span id="openSidebar" onclick="openNav()">
            open
        </span>
        <span id="topSearchbar">
            <input type="text" placeholder="Search..." name="search">
            <button type="submit">Search</button>
        </span>
        <span id="filterIcon">
            <button onclick="popupModal(event, 'filterModal')">Filter</button>
            <div id="filterModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal(event, 'filterModal')">&times;</span>
                    <p>content
                </div>
            </div>
        </span>
    </div>
</header>