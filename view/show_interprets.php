<?php
require_once "classInterpret.php";
require_once "connect_db.php";
require_once "get_all.php";
$pdo = connect_db();
$interprets = get_interprets($pdo);
?>

<table class="table">
    <thead>
    <h1>Interpreti</h1>
    <tr>
        <th>ID</th>
        <th>Meno</th>
        <th>Hodnotenie</th>
        <th>Fotka</th>
        <th> Festivaly </th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($interprets as $interpret){

    ?>
    <form name="change_interpret" method="post" action="../update_interprets.php?id=<?php echo $interpret->getID();?>">
    <tr>
        <td>
            <a class="no_color_change_link" id="interpret_id"><?php echo $interpret->getID();?></a>
        </td>
        <td>
            <input name="meno" type="text" placeholder=<?php echo $interpret->getNazov($pdo);?> id="meno">
        </td>
        <td>
            <input name="rating" type="text" placeholder=<?php echo $interpret->getHodnotenie($pdo);?> id="interpret_rating">
        </td>
        <td>
            <input type="file" name="artist_foto" value="<?php echo $interpret->getLogo($pdo);?>"/>
        </td>
        <td>
            <div class="form-group">
                <select class="custom-select" multiple>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                </select>
        </td>
        <td>
            <button type="button" id="align-right" class="btn btn-danger" onclick="location.href='delete.php?type=INTERPRET&id=<?php echo $interpret->getID()?>'"> Odstrániť </button> </td>
        <td><button type="submit" id="align-right" class="btn btn-info" onclick=""> Potvrdiť zmeny </button></td>
    </tr>
    </form>
        <?php
    }
    ?>
    </tbody>
</table>