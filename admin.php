<?php
require "common.php";
require_admin();
make_head();
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin_page.css">
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" id="admin-page" href="#">Admin page</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Domov</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa vstupeniek
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Potvrdiť rezerváciu</a>
                    <a class="dropdown-item" href="#">Stornovať rezerváciu</a>
                    <a class="dropdown-item" href="#">Vydať vstupenky</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa festivalov
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Pridať festival</a></li>
                    <li class="dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="nav-label">Upraviť festival</span><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Zmeniť dátum festivalu</a></li>
                            <li><a href="#">Vytvoriť rozpis</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Odstániť festival</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa Interpretov
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Pridať interpreta</a>
                    <a class="dropdown-item" href="#">Upraviť interpreta</a>
                    <a class="dropdown-item" href="#">Prihlásiť interpreta na festival</a>
                    <a class="dropdown-item" href="#">Odstániť interpreta</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa užívateľov</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Pridať užívateľa</a></li>
                    <li class="dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="nav-label">Upraviť užívateľa</span><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Zmeniť oprávnenie</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Odstániť užívateľa</a></li>
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
</body>



<?php
make_footer();
?>