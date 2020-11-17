<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať nového interpreta</h2>
        <form action="../interpret_insert.php" class="form-container" method="post">
            <input type="text" placeholder="meno" name="nazov" required>
            <input type="text" placeholder="hodnotenie" name="hodnotenie">
            <center>
                <input type="file" name="obr" id="artist_align">
            </center>
            <select name="artist_genre" id="artist_genre" multiple>
                <!--  TU BUDE FUNKCIA Z TRIEDY ZANROV -->
                <option value="rock">Rock</option>
                <option value="pop">Pop</option>
                <option value="dnb">Drum and Bass</option>
            </select>
            <br>
            <br>
            <button type="submit" class="btn btn-info" >Pridať</button>
            <button type="submit" class="btn btn-danger" onclick=closeForm("add_interprets")>Zatvoriť</button>
            <br>
        </form>
    </div>
</div>