<?php
require_once "connect_db.php";
require_once "controller.php";
require_once "classZaner.php";

$pdo = connect_db();
$zanre = get_zanre($pdo);
?>
<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať nového interpreta</h2>
        <form action="interpret_insert.php" class="form-container" method="post">
            <input type="text" placeholder="meno" name="nazov" required>
            <input type="text" placeholder="hodnotenie" name="hodnotenie">
            <center>
                <input type="file" name="obr" id="artist_align">
            </center>
            <select name="zaner[]" id="artist_genre" multiple>
                <?php
                foreach ($zanre as $zaner){
                    echo "<option value=".$zaner->getID().">".$zaner->getZaner_nazov($pdo)."</option>";
                }
                ?>
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