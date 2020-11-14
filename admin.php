<?php
require "common.php";
require_admin();
make_head();
?>
    <script type="text/javascript" src="view/show_elements.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="view/css/admin_page.css">
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" id="admin-page" href="#">Admin page</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Domov</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" onclick=showItems("tickets") id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa vstupeniek
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa festivalov
                </a>
                <ul class="dropdown-menu">
                    <li><a onclick=openForm("add_festivals")>Pridať festival</a></li>
                    <li><a onclick=showItems("festivals") >Upraviť festival</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa interpretov
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" onclick=openForm("add_interprets")>Pridať interpreta</a>
                    <a class="dropdown-item" onclick=showItems("interprets")>Upraviť interpreta</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa užívateľov</a>
                <ul class="dropdown-menu">
                    <li><a onclick=openForm("add_user")>Pridať užívateľa</a></li>
                    <li><a onclick=showItems("users")>Upraviť užívateľa</a></li>
                </ul>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Vyhladať" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Vyhladať</button>
        </form>
        <div class="nav-item">
            <a class="nav-link" href="logout.php">Odhlásiť</a>
        </div>
    </div>
</nav>

<div class="form-popup" id="add_festivals">
    <?php
    require("view/add_festival.php");
    ?>
</div>

<div class="form-popup" id="add_interprets">
    <?php
    require("view/add_artist.php");
    ?>
</div>

<div class="form-popup" id="add_user">
    <?php
    require("view/add_user.php");
    ?>
</div>

<div class="container" id="container">
    <div class="col-sm" id="tickets">
            <?php
            require("view/show_tickets.php");
            ?>
    </div>
    <div class="col-sm" id="festivals">
            <?php
            require("view/show_festivals.php");
            ?>
    </div>
    <div class="col-sm" id="interprets">
            <?php
            require("view/show_interprets.php");
            ?>
    </div>
    <div class="col-sm" id="users">
            <?php
            require("view/show_users.php");
            ?>
    </div>
</div>

</body>

<?php
make_footer();
?>




