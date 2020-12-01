 <?php
require "../classInterpret.php";
require "../classFestival.php";
require "../classPodium.php";
require_once "../connect_db.php";
require_once "../controller.php";
require_once "../common.php";

$pdo = connect_db();
$interpret = new Interpret();
$festival = new Festival();
$interpretArray = $interpret->getAllInterpret($pdo);
$podiumArray = getPodiaForFestival($pdo, $_GET['id']);
$festival->initExistingFestival($pdo,$_GET['id']);
$datumOd = date_parse_from_format('Y-m-d H:i:s', $festival->getDatum_Od($pdo));
$datumDo = date_parse_from_format('Y-m-d H:i:s', $festival->getDatum_Do($pdo));
make_head();
?>
 <link rel="stylesheet" href="css/create_lineup.css">
 <body>
<div class="create_lineup">
    <div class="centering">
        <h4>Pridat podia</h4>
        <form action="../update_festivals.php?id=<?php echo $_GET['id'];?>" method="post" name="update_festival">
        <input name="podium_add" type="text" placeholder="Názov">
        <button type="submit" class="btn btn-danger" id="add-podium">Pridat podium</button>
        </form>
        <h4>Pridata interpreta na festival</h4>
        <?php
        try{
        ?>
        <form action="../interpret_to_festival_insert.php?id=<?php echo $_GET['id'];?>" method="post" name="add_interpret">
            <select class="custom-select" name="podium" id='podium' required>
                <option value="">Vybrať podium</option>
                <?php
                foreach ($podiumArray as $podium) {
                    echo "<option value='".$podium->getID()."'>".$podium->getNazov($pdo)."</option>";
                }
                ?>
            </select>
            <select class="custom-select" name="interpret" required>
                <option value="">Vybrať Interpreta</option>
                <?php
                foreach ($interpretArray as $interpret) {
                    echo "<option value='".$interpret->getID()."'>".$interpret->getNazov($pdo)."</option>";
                }
                ?>
            </select>
            <input type="datetime-local" name="timeslot" required>
            <button type="submit" class="btn btn-danger" id="add-podium">Pridat interpreta</button>
        </form> <?php
        }catch (Exception $e) {
            echo "<p>Vystupenie mimo datum konania festivalu!</p>";
        }
        ?>
        <h4>Odstranit vystupenie</h4>
                <?php
                echo "<table>";
                foreach ($podiumArray as $podium) {
                    ?>
                    <form action="../delete.php?type=VYSTUPENIE&id=<?php echo $podium->getID();?>&redirect=<?php echo $festival->getID();?>" method="post" name="del_vystupenie"> <?php
                        delete_vystupenie($podium,$pdo); ?>
                    </form>
            <?php
                }
                echo "</table>";
                ?>
        <h4>VYTVORIŤ ROZPIS</h4>
            <?php
                createDays($pdo,$interpretArray,$podiumArray,$datumOd,$datumDo);
            ?>
            <button type="submit" class="btn btn-danger" id="remove-lineup" onclick="window.location.href='../admin.php'">Zrušiť</button>
    </div>
</div>
 </body>
