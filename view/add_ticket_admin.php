<?php
require_once "connect_db.php";
require_once "classRegistrovany.php";
require_once "classNeregistrovany.php";
require_once "classFestival.php";

$pdo = connect_db();
$neregistrovany = new Neregistrovany();
$registrovany = new Registrovany();
$festival = new Festival();
$registrovanyArray = $registrovany->getAllRegistrovany($pdo);
$neregistrovanyArray = $neregistrovany->getAllNeregistrovany($pdo);
$festivalArray = $festival->getAllFestival($pdo);
?>
<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať novu vstupenku</h2>
        <form action="vstupenka_insert.php" class="form-container" method="post">
            <select name="festival_ID" id="festival_ID" required>
                <option value="">festival_ID</option>
                <?php
                foreach ($festivalArray as $fest){
                    echo '<option value="'.$fest->getID().'">'.$fest->getID().'</option>';
                }
                ?>
            </select>
            <select name="registrovany_ID" id="registrovany_ID">
                <option value="-1">registrovany_ID</option>
                <?php
                foreach ($registrovanyArray as $regist){
                    echo '<option value="'.$regist->getID().'">'.$regist->getID().'</option>';
                }
                ?>
            </select>
            <select name="neregistrovany_ID" id="neregistrovany_ID">
                <option value="-1">neregistrovany_ID</option>
                <?php
                foreach ($neregistrovanyArray as $neregist){
                    echo '<option value="'.$neregist->getID().'">'.$neregist->getID().'</option>';
                }
                ?>
            </select>
            <select name="stav" id="stav">
                <option value="">stav</option>
                <option value="v kosiku">v kosiku</option>
                <option value="rezervovana">rezervovana</option>
                <option value="potvrdena">potvrdena</option>
                <option value="stornovana">stornovana</option>
                <option value="vydana">vydana</option>
            </select>
            <br>
            <br>
            <button type="submit" class="btn btn-info" >Pridať</button>
            <button type="submit" class="btn btn-danger" onclick=closeForm("add_tickets_admin")>Zatvoriť</button>
            <br>
        </form>
    </div>
</div>
