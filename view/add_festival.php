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