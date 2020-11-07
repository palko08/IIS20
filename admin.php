<?php
require "common.php";
require_admin();
make_head();
?>

<script>
    function showItems(itemID) {
        var x = document.getElementById(itemID);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

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
            <li class="nav-item active">
                <a class="nav-link" onclick=showItems("tickets") id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa vstupeniek
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" onclick=showItems("festivals") id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa festivalov
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">Pridať festival</a></li>
                    <li><a onclick=showItems("tickets") >Upraviť festival</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" onclick=showItems("interprets") id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa interpretov
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Pridať interpreta</a>
                    <a class="dropdown-item" href="#">Upraviť interpreta</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" onclick=showItems("users") id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Správa užívateľov</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Pridať užívateľa</a></li>
                    <li class="dropdown-submenu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="nav-label">Upraviť užívateľa</span><span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Zmeniť oprávnenie</a></li>
                        </ul>
                    </li>
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

<div class="container" id="container">
    <div class="col-sm" id="tickets">
        <table class="table">
            <?php
            show_tickets();
            ?>
        </table>
    </div>
    <div class="col-sm" id="festivals">
        <table class="table">
            <?php
            show_festivals();
            ?>
        </table>
    </div>
    <div class="col-sm" id="interprets">
        <table class="table">
            <?php
            show_interprets();
            ?>
        </table>
    </div>
    <div class="col-sm" id="users">
        <table class="table">
            <?php
            show_users();
            ?>
        </table>
    </div>
</div>

</body>



<?php
make_footer();
function show_tickets(){
    ?>
    <thead>
            <h1>Vstupenky</h1>
            <tr>
                <th>ID</th>
                <th>email</th>
                <th>Stav</th>
                <th>Cena</th>
            </tr>
            </thead>
            <tbody>
            <!-- TOTO SA HODI DO CLASS FUNKCIE -->
            <tr>
                <td>
                    <a class="no_color_change_link" id="ticket" href="#">vstupenka</a>
                </td>
                <td>
                    <a class="no_color_change_link" id="ticket_email">email</a>
                </td>
                <td>
                    <a class="no_color_change_link" id="stav">stav</a>
                    <button type="button" id="align-right"> potvrdiť </button>
                    <button type="button" id="align-right"> stornovať </button>

                </td>
                <td>
                    <a class="no_color_change_link" id="cena">cena</a>
                    <button type="button" id="align-right"> vydať </button>
                </td>
            </tr>
            <!-- TOTO SA HODI DO FUNKCIE -->

            </tbody>
    <?php
}

function show_festivals(){
    ?>
    <thead>
    <h1>Festivaly</h1>
    <tr>
        <th>ID</th>
        <th>Názov</th>
        <th>Dátum Od</th>
        <th>Dátum Do</th>
        <th>Max. kapacita</th>
        <th>Popis</th>
        <th>Obrázok</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <!-- TOTO SA HODI DO FUNKCIE -->
    <tr>
        <td>
            <a class="no_color_change_link" id="festival_id" href="#">ID</a>
        </td>
        <td>
            <a class="no_color_change_link" id="festival_name">festival</a>
        </td>
        <td>
            <input placeholder="aktualny datum festivalu od" type="date" id="festival_date_from" class="form-control">
        </td>
        <td>
            <input placeholder="daktualny datum festivalu do" type="date" id="festival_date_to" class="form-control">
        </td>
        <td>
            <input placeholder="aktuálna kapacita festivalu" id="festival_capacity" class="form-control">
        </td>
        <td>
            <input placeholder="aktuálny popis festivalu" id="festival_description" class="form-control">
        </td>
        <td>
            <input type="file" name="file"/>
        </td>
        <td>
            <button type="button" id="align-right"> Potvrdiť zmeny</button>
        </td>
        <td>
            <button type="button" id="align-right" href="#rozpis"> Vytvoriť rozpis</button>
        </td>
        <td>
            <button type="button" id="align-right"> Odstrániť </button>
        </td>
    </tr>
    <!-- TOTO SA HODI DO FUNKCIE -->

    </tbody>
    <?php
}

function show_interprets(){
    ?>
    <thead>
    <h1>Interpreti</h1>
    <tr>
        <th>ID</th>
        <th>Meno</th>
        <th>Hodnotenie</th>
        <th>Fotka</th>
        <th> Pridať na festival </th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <!-- TOTO SA HODI DO CLASS FUNKCIE -->
    <tr>
        <td>
            <input type="text" placeholder="intrepretID" id="interpret_id">
        </td>
        <td>
            <input type="text" placeholder="meno" id="interpret_name">
        </td>
        <td>
            <input type="text" placeholder="hodnotenie" id="interpret_rating">
        </td>
        <td>
            <input type="file" name="file"/>
        </td>
        <td>
            <div class="form-group">
                <select class="custom-select">
                    <option value="">Vybrať festival</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
        </td>
        <td>
            <button type="button" id="align-right"> vymazať </button>
            <button type="button" id="align-right"> potvrdiť zmeny </button>
        </td>
    </tr>
    <!-- TOTO SA HODI DO FUNKCIE -->

    </tbody>
    <?php
}

function show_users(){
    ?>
    <thead>
    <h1>Užívatelia</h1>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Meno</th>
        <th>Login</th>
        <th>Heslo</th>
        <th>Oprávnenie</th>
        <th>Fotka</th>
    </tr>
    </thead>
    <tbody>
    <!-- TOTO SA HODI DO CLASS FUNKCIE -->
    <tr>
        <td>
            <input type="text" placeholder="USERID" id="user_id">
        </td>
        <td>
            <input type="email" placeholder="email" id="user_email">
        </td>
        <td>
            <input type="text" placeholder="Meno" id="user_name">
        </td>
        <td>
            <input type="text" placeholder="login" id="user_login">
        </td>
        <td> <input type="password" placeholder="password" id="user_password" ></td>
        <td>
            <div class="form-group">
                <select class="custom-select">
                    <option value="">Vybrať level oprávnenia</option>
                    <option value="0">admin</option>
                    <option value="1">poradatel</option>
                    <option value="2">pokladní</option>
                    <option value="3">divák</option>
                </select>
        </td>
        <td>
            <input type="file" name="file"/>
        </td>
        <td>
            <button type="button" id="align-right"> vymazať </button>
            <button type="button" id="align-right"> potvrdiť zmeny </button>
        </td>
    </tr>
    </tbody>
    <?php
}

?>