<?php
require_once "get_all.php";
require_once "connect_db.php";

$pdo = connect_db();
$festivals = get_festivals($pdo);
$interprets = get_interprets($pdo);
?>

<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať interpreta na festival</h2>
        <form name="add_user" action="" method="post" class="form-container" target="dummyframe">
            <select class="custom-select" name="festival" required>
                <option value="">Vybrať festival</option>
                <?php
                foreach ($festivals as $festival) {
                    echo "<option value='".$festival->getID()."'>".$festival->getNazov($pdo)."</option>";
                }
                ?>
            </select>
            <select class="custom-select" name="interpret" required>
                <option value="">Vybrať Interpreta</option>
                <?php
                foreach ($interprets as $interpret) {
                    echo "<option value='".$interpret->getID()."'>".$interpret->getNazov($pdo)."</option>";
                }
                ?>
            </select>
            <br> <br>
            <button type="submit" class="btn btn-info" value="Register" onClick="#TODO">Pridať</button>
            <button type="submit" class="btn btn-danger" onclick=closeForm("add_interpret_festival")>Zatvoriť</button>
        </form>
    </div>
</div>