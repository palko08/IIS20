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
    require("create_lineup.php");
    ?>
