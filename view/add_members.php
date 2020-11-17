<?php
require_once "get_all.php";
require_once "connect_db.php";

$pdo = connect_db();
$interprets = get_interprets($pdo);
?>

<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať členov interpreta</h2>
        <form name="add_user" action="../add_member.php" method="post" class="form-container" target="dummyframe">
            <select class="custom-select" name="interpret" required>
                <option value="">Vybrať Interpreta</option>
                <?php
                foreach ($interprets as $interpret) {
                    echo "<option value='".$interpret->getID()."'>".$interpret->getNazov($pdo)."</option>";
                }
                ?>
            </select>
            <br> <input name="meno" type="text" class="input-sm" placeholder="meno">
            <button type="submit" class="btn btn-info">Pridať člena</button>
            <button class="btn btn-danger" onclick=closeForm("add_interpret_member")>Zatvoriť</button>
        </form>
        <?php
            $interpret = new Interpret();
            $interpret->initExistingInterpret($pdo,1);
            $clenovia = $interpret->getClenov($pdo);
        ?><h2><?php var_dump($clenovia);?></h2>
    </div>
</div>