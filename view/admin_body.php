<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" id="admin-page" href="#">Admin page</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Domov</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa vstupeniek
                </a>
                <ul class="dropdown-menu">
                    <li><a onclick=openForm("add_tickets_admin")>Pridať vstupenku</a></li>
                    <li><a onClick=gotoDiv("tickets") >Upraviť vstupenky</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa festivalov
                </a>
                <ul class="dropdown-menu">
                    <li><a onclick=openForm("add_festivals")>Pridať festival</a></li>
                    <li><a onClick=gotoDiv("festivals") >Upraviť festival</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa interpretov
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" onclick=openForm("add_interprets")>Pridať interpreta</a>
                    <a class="dropdown-item" onclick=gotoDiv("interprets")>Upraviť interpreta</a>
                  <a class="dropdown-item" onclick=openForm("add_interpret_member")>Pridať člena</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa užívateľov</a>
                <ul class="dropdown-menu">
                    <li><a onclick=openForm("add_user")>Pridať užívateľa</a></li>
                    <li><a onclick=gotoDiv("users")>Upraviť užívateľa</a></li>
                </ul>
            </li>
        </ul>
        <div class="nav-item">
            <a class="nav-link" href="logout.php">Odhlásiť</a>
        </div>
    </div>
</nav>