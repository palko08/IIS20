<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať nový festival</h2>
        <form action="../festival_insert.php" class="form-container" method="post">
            <table class="center">
                <tr>
                    <td><input name="nazov" class="form-control" type="text" placeholder="meno" required></td>
                    <td><select name="adresa" class="form-control"id="festival_address">
                            <option value="">Adresa</option>
                            <option value="1">Niekde 26</option>
                            <option value="2">Dakde 44</option>
                            <option value="3">Tuto 17</option>
                        </select></td>
                    <td> <input class="form-control" type="date" placeholder="od" name="od"></td>
                    <td>  <input class="form-control" type="date" placeholder="do" name="do"></td>
                    <td><input class="form-control" type="text" placeholder="hodnotenie" name="hodnotenie"></td>
                    <td><input class="form-control" type="number" placeholder="kapacita" name="kapacita"></td>
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