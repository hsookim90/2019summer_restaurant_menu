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
        <a href="#" id="logo">CompanyLogo</a>

        <div class="searchbar">
            <input type="text" placeholder="Search..." name="search">
            <button type="submit">Search</button>
        </div>

        <!-- Use any element to open the sidenav -->
        <span onclick="openNav()">open</span>
    </div>
</header>