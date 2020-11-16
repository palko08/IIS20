<?php
require "classFestival.php";
require_once "connect_db.php";
$pdo = connect_db();
$idSelect = $pdo->prepare("SELECT festival_ID FROM Festival");
$idSelect->execute();

$results = $idSelect->fetchAll();

$festivals = array();

foreach($results as $row) {
    $festival = new Festival();
    if($festival->initExistingFestival($pdo, $row[0]) == -1){
        echo "nenasli sme v databazke dany row<br>";
    }
    $festivals[] = $festival;
}
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
    <?php
        foreach ($festivals as $festival){
    ?>
    <form name="change_festival" method="post" action="">
    <tr>
        <td>
            <a class="no_color_change_link" id="festival_id" href="#"><?php echo $festival->getID();?></a>
        </td>
        <td>
            <input type="text" id="festival_name" placeholder=<?php echo $festival->getNazov($pdo);?>></a>
        </td>
        <td>
            <select class="form-control" name="festival_address">
                <option value=""><?php echo $festival->getAdresa($pdo);?></option>
                <option value="1">Niekde 26</option>
                <option value="2">Dakde 44</option>
                <option value="3">Tuto 17</option>
            </select>
        </td>
        <td>
            <input type="date" id="festival_date_from" class="form-control" value=<?php echo $festival->getDatum_Od($pdo);?>>
        </td>
        <td>
            <input type="date" id="festival_date_to" class="form-control" value=<?php echo $festival->getDatum_Do($pdo);?>>
        </td>
        <td>
            <input id="festival_capacity" class="form-control" placeholder="<?php echo $festival->getKapacita($pdo);?>">
        </td>
        <td>
            <input type="number" id="festival_price" class="form-control" placeholder=<?php echo $festival->getCena($pdo);?>>
        </td>
        <td>
            <button type="button" class="align-right" name="delete_btn" onclick="location.href='delete.php?type=FESTIVAL&id=<?php echo $festival->getID()?>'"> Odstrániť </button>
        </td>
        <td>
            <button type="button" class="align-right"> Potvrdiť zmeny</button>
        </td>
    </tr>
    </form>
    <?php
        }
    ?>
    </tbody>
    </table>


    <?php

    //require("create_lineup.php");
    ?>
