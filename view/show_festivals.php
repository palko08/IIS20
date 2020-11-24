<?php
require_once "classFestival.php";
require_once "connect_db.php";
require_once "controller.php";

$pdo = connect_db();
$festivals = get_festivals($pdo);
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
        <th>Zanre</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($festivals as $festival){
    ?>
    <form name="change_festival" method="post" action="update_festivals.php?id=<?php echo $festival->getID();?>">
    <tr>
        <td>
            <a class="no_color_change_link" id="festival_id" href="#"><?php echo $festival->getID();?></a>
        </td>
        <td>
            <input type="text" id="festival_name" name="festival_name" placeholder=<?php echo $festival->getNazov($pdo);?>></a>
        </td>
        <td>
            <select class="form-control" name="festival_address">
                <option value="<?php echo $festival->getAdresa($pdo);?>"><?php echo $festival->getAdresa($pdo);?></option>
                <option value="Niekde 26">Niekde 26</option>
                <option value="Dakde 44">Dakde 44</option>
                <option value="Tuto 17">Tuto 17</option>
            </select>
        </td>
        <td>
            <input type="date" id="festival_date_from" name="festival_date_from" class="form-control" value=<?php echo $festival->getDatum_Od($pdo);?>>
        </td>
        <td>
            <input type="date" id="festival_date_to" name="festival_date_to" class="form-control" value=<?php echo $festival->getDatum_Do($pdo);?>>
        </td>
        <td>
            <input id="festival_capacity" name="festival_capacity" class="form-control" placeholder="<?php echo $festival->getKapacita($pdo);?>">
        </td>
        <td>
            <input type="number" id="festival_price" name="festival_price" class="form-control" placeholder=<?php echo $festival->getCena($pdo);?>>
        </td>
        <td>
            <div class="form-group">
                <select class="custom-select" multiple>
                    <?php
                    //TODO update zanrov
                    print_zanre($festival,$pdo,"multiple");
                    ?>
                </select>
        </td>
        <td>
            <button type="button" id="align-right" class="btn btn-danger" name="delete_btn" onclick="location.href='delete.php?type=FESTIVAL&id=<?php echo $festival->getID()?>'"> Odstrániť </button>
        </td>
        <td>
            <button type="submit" id="align-right" class="btn btn-info" onclick=""> Potvrdiť zmeny</button>
        </td>
        <td>
            <a href="view/create_lineup.php?id=<?php echo $festival->getID()?>"><button type="button" class="btn btn-warning">Vytvoriť rozpis</button></a>
    </tr>
    </form>
            <?php
        }
    ?>
    </tbody>
    </table>
