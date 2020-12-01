<?php
require_once "controller.php";
require_once "connect_db.php";

$pdo = connect_db();
$festivals = get_festivals($pdo);
$interprets = get_interprets($pdo);
?>

<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

<div class="jumbotron">
    <p class="span8 centering">
        <h2>Pridať interpreta na festival</h2>
        <form name="interpret_to_festival_insert.php" action="" method="post" class="form-container" target="dummyframe">
            <select class="custom-select" name="festival" id='festival' required>
                <option value="">Vybrať festival</option>
                <?php
                foreach ($festivals as $festival) {
                    echo "<option value='".$festival->getID()."'>".$festival->getNazov($pdo)."</option>";
                }
                ?>
            </select>
            <select class="custom-select" name="podium" id='podium' required>
                <option value="">Vybrať podium</option>
                <?php
                $id = "";
                $podiums = getPodiaForFestival($pdo,$id);
                echo "<option value='0'>".$id."</option>";
                foreach ($podiums as $podium) {
                    echo "<option value='".$podium->getID()."'>".$id."</option>";
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
            <button type="submit" class="btn btn-info">Pridať</button>
            <button type="submit" class="btn btn-danger" onclick=closeForm("add_interpret_festival")>Zatvoriť</button>
        </form>
    </div>
</div>
