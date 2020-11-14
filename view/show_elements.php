<script>
    function showItems(itemID) {
        var x = document.getElementById(itemID);
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    function openForm(itemID) {
        document.getElementById(itemID).style.display = "block";
    }

    function closeForm(itemID) {
        document.getElementById(itemID).style.display = "none";
    }

</script>

<!-- HIDDEN ELEMENTS FUNCTIONS  -->
<?php

function show_tickets(){
    ?>
    <table class="table">
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
    </table>
    <?php
}

function show_festivals(){
    //TODO POPIS, OBRazok a hodnotenie zmena pri profile festivalu
    ?>
    <table class="table">
    <thead>
    <h1>Festivaly</h1>
    <tr>
        <th>ID</th>
        <th>Názov</th>
        <th>Adresa</th>
        <th>Dátum Od</th>
        <th>Dátum Do</th>
        <th>Max. kapacita</th>
        <th>Cena</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <!-- TOTO SA HODI DO FUNKCIE, placeholderi budu aktualne hodnoty -->
    <tr>
        <td>
            <a class="no_color_change_link" id="festival_id" href="#">ID</a>
        </td>
        <td>
            <input type="text" id="festival_name" placeholder="festival name"></a>
        </td>
        <td>
            <select class="form-control" name="festival_address">
                <option value="">Aktualna adresa</option>
                <option value="1">Niekde 26</option>
                <option value="2">Dakde 44</option>
                <option value="3">Tuto 17</option>
            </select>
        </td>
        <td>
            <input type="date" id="festival_date_from" class="form-control">
        </td>
        <td>
            <input type="date" id="festival_date_to" class="form-control">
        </td>
        <td>
            <input placeholder="aktuálna kapacita festivalu" id="festival_capacity" class="form-control">
        </td>
        <td>
            <input type="number" placeholder="cena" id="festival_price" class="form-control">
        </td>
        <td>
            <button type="button" class="align-right"> Potvrdiť zmeny</button>
        </td>
        <td>
            <button type="button" class="align-right"> Odstrániť </button>
        </td>
    </tr>
    <!-- TOTO SA HODI DO FUNKCIE -->

    </tbody>
    </table>
    <?php
    create_lineup();
}

function create_lineup(){
    ?>
    <div class="create_lineup">
        <div class="centering">
            <h4>VYTVORIŤ ROZPIS</h4>
            <input type="number" min=0 placeholder="Počet podií">
            <label for="lineup_date">Den</label>
            <input type="date" id="lineup_date">
            <label for="lineup_time_from">Casovy interval od:</label>
            <input type="time" id="lineup_time_from">
            <label for="lineup_time_to">do:</label>
            <input type="time" id="lineup_time_to">

            <div class="add_timeslots">
            <table class="borders" id="lineup-table">
                <thead>
                <tr>
                <th class="borders">podium/cas</th>
                <th class="borders">18:00</th>
                <th class="borders">19:00</th>
                <th class="borders">20:00</th></tr>
                </thead>
                <tbody>
                <tr>
                    <td class="borders"><b> PODIUM 1</b> </td>
                    <td>
                        <select name="select_interprets_timeslots">
                            <option value="subfocus">Sub focus</option>
                            <option value="dimension">Dimension</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots">
                            <option value="subfocus">Sub focus</option>
                            <option value="dimension">Dimension</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots">
                            <option value="subfocus">Sub focus</option>
                            <option value="dimension">Dimension</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="borders"><b>PODIUM 2</b>  </td>
                </tr>
                </tbody>
            </table>
            <button class="btn btn-success" id="confirm-lineup">Potvrdiť rozpis</button>
                <button type="submit" class="btn btn-danger" id="remove-lineup">Zrušiť</button>
        </div>
        </div>
    </div>
    <?php
}

function show_interprets(){
    ?>
    <table class="table">
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
            <a class="no_color_change_link" id="interpret_id">ID</a>
        </td>
        <td>
            <input type="text" placeholder="meno" id="interpret_name">
        </td>
        <td>
            <input type="text" placeholder="hodnotenie" id="interpret_rating">
        </td>
        <td>
            <input type="file" name="artist_foto"/>
        </td>
        <td>
            <div class="form-group">
                <select class="custom-select" multiple>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                </select>
        </td>
        <td>
            <button type="button" id="align-right"> vymazať </button>
            <button type="button" id="align-right"> potvrdiť zmeny </button>
        </td>
    </tr>
    <!-- TOTO SA HODI DO FUNKCIE -->

    </tbody>
    </table>
    <?php
}

function show_users(){
    ?>
    <table class="table">
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
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <!-- TOTO SA HODI DO CLASS FUNKCIE -->
    <tr>
        <td>
            <a class="no_color_change_link" id="user_id">ID</a>
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
            <input type="file" name="users_foto"/>
        </td>
        <td>
            <button type="button" id="align-right"> vymazať </button>
        </td>
        <td><button type="button" id="align-right"> potvrdiť zmeny </button></td>
    </tr>
    </tbody>
    </table>
    <?php
}


/* ADD NEW ITEMS TO DATABASE FUNCTIONS  */

function add_user_popup(){
    //TODO typ oprávnenia
    ?>

    <div class="jumbotron">
    <div class="span8 centering">
    <h2>Pridať nového užívateľa</h2>
    <form action="account_insert.php" method="post" class="form-container">
    <input type="text" placeholder="login" name="login" required>
        <input type="text" placeholder="meno" name="meno" required>
    <input type="password" placeholder="password" name="password" required>
    <input type="email" placeholder="email@email.com" name="email">
    <select class="custom-select">
                    <option value="">Vybrať level oprávnenia</option>
                    <option value="0">admin</option>
                    <option value="1">poradatel</option>
                    <option value="2">pokladní</option>
                    <option value="3">divák</option>
    </select>
    <br>
    <button type="submit" class="btn btn-info" value="Register">Pridať</button>
    <button type="submit" class="btn btn-danger" onclick=closeForm("add_user")>Zatvoriť</button>
    </form>
        </div>
     </div>
   <?php
}

function add_artist_popup(){
?>
    <div class="jumbotron">
        <div class="span8 centering">
            <h2>Pridať nového interpreta</h2>
            <form action="#" class="form-container">
                <input type="text" placeholder="meno" name="artist_name" required>
                <input type="text" placeholder="hodnotenie" name="interpret_rating">
                <center>
                <input type="file" name="artist_foto" id="artist_align">
                </center>
                <select name="artist_genre" id="artist_genre" multiple>
                    <!--  TU BUDE FUNKCIA Z TRIEDY ZANROV -->
                    <option value="rock">Rock</option>
                    <option value="pop">Pop</option>
                    <option value="dnb">Drum and Bass</option>
                </select>
                <br>
                <label>Clenovia</label>
                <br>
                <text id="members">clen1</text>
                <br>
                <button type="submit" class="btn btn-info">Pridať</button>
                <button type="submit" class="btn btn-danger" onclick=closeForm("add_interprets")>Zatvoriť</button>
                <br>
            </form>
            <form action="#" method="post">
                <input name="member_name" type="text" class="input-sm" placeholder="Meno">
                <input name="member_surname" type="text" class="input-sm" placeholder="Priezvisko">
                <button type="submit" class="btn btn-primary">Pridat člena</button>
            </form>
        </div>
    </div>
    <?php
}

function add_festival_popup(){
?>
    <div class="jumbotron">
        <div class="span8 centering">
            <h2>Pridať nový festival</h2>
            <form action="#" class="form-container">
                <table class="center">
                <tr>
                <td><input class="form-control" type="text" placeholder="meno" name="festival_name" required></td>
                <td><select class="form-control" name="festival_address" id="festival_address">
                    <option value="">Adresa</option>
                    <option value="1">Niekde 26</option>
                    <option value="2">Dakde 44</option>
                    <option value="3">Tuto 17</option>
                </select></td>
                   <td> <input class="form-control" type="date" placeholder="od" name="festival_date_from"></td>
                  <td>  <input class="form-control" type="date" placeholder="do" name="festival_date_to"></td>
                    <td><input class="form-control" type="text" placeholder="hodnotenie" name="festival_rating"></td>
                    <td><input class="form-control" type="number" placeholder="kapacita" name="festival_capacity"></td>
                    <td><input class="form-control" type="number" placeholder="cena" name="festival_price"></td>
                    <td> <input type="file" name="festival_foto" id="artist_align"></td>
                </tr>
                <tr>
                    <td><select class="form-control" name="festival_genre" id="festival_genre" multiple>
                    <!--  TU BUDE FUNKCIA Z TRIEDY ZANROV -->
                    <option value="rock">Rock</option>
                    <option value="pop">Pop</option>
                    <option value="dnb">Drum and Bass</option>
                </select> </td>

                <td><textarea placeholder="Popis..." class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea></td>

                </tr>
        </table>
                <button type="submit" class="btn btn-info">Pridať</button>
                <button type="submit" class="btn btn-danger" onclick=closeForm("add_festivals")>Zatvoriť</button>
            </form>
    </div>
    </div>
    <?php
}
?>