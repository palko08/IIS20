 <?php
require "../classInterpret.php";
require "../classFestival.php";
require "../classPodium.php";
require_once "../connect_db.php";
require_once "../controller.php";
require_once "../common.php";


function createDays($pdo,$interpretArray,$podiumArray,$datumOd,$datumDo){
    for ($i = $datumOd['day']; $i <= $datumDo['day']; $i++) {
        $cnt = 0;
    echo '
    <b name="den">'.$i.'.'.$datumOd['month'].'.'.$datumOd['year'].'</b>
            <table class="borders" id="lineup-table">
                <thead>
                <tr>
                    <th class="borders">podium/cas</th>';
                    if ($i == $datumOd['day']) {
                        for ($j = $datumOd['hour']; $j < 24; $j++) {
                            echo '<th class="borders">'.$j.':00'.'</th>';
                            $cnt++;
                        }
                    }
                    else if ($i != $datumDo['day']){
                        for ($j = 0; $j < 24; $j++) {
                            echo '<th class="borders">'.$j.':00'.'</th>';
                            $cnt++;
                        }
                    }
                    else {
                        for ($j = 0; $j < $datumDo['hour']; $j++) {
                            echo '<th class="borders">'.$j.':00'.'</th>';
                            $cnt++;
                        }
                    }
                    echo'
                </tr>
                </thead>
                <tbody>';
                foreach ($podiumArray as $podium) {
                echo '
                <tr>
                    <td class="borders"><b>'.$podium->getNazov($pdo).'</b></td>';
                    for ($k = 0; $k < $cnt; $k++) {
                    echo '
                    <td>    ';
                            $cas = $datumOd;
                            if ($i == $datumOd['day']) {
                                $cas['hour'] += $k;
                            }
                            elseif ($i != $datumDo['day']) {
                                $cas['day'] += $i - $datumOd['day'];
                                $cas['hour'] = $k;
                            }
                            else {
                                $cas = $datumDo;
                                $cas['hour'] = $k;
                            }
                            $interpret = getInterpretForTime($pdo, $cas, $podium->getID());
                            if ($interpret != NULL) {
                                echo '<p>'.$interpret->getNazov($pdo).'</p>';
                            }
                            else {
                                echo '<p>none</p>';
                            }
                            echo '
                    </td>';
                    }
                    echo '
                </tr>';
            }
            echo '
                </tbody>
            </table>
    ';
    }
}

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
 <body>
<div class="create_lineup">
    <div class="centering">
        <h4>Pridat podia</h4>
        <form action="../update_festivals.php?id=<?php echo $_GET['id'];?>" method="post" name="update_festival">
        <input name="podium_add" type="text" placeholder="Názov">
        <button type="submit" class="btn btn-danger" id="add-podium">Pridat podium</button>
        </form>
        <h4>Pridata interpreta na festival</h4>
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
        </form>
        <h4>Odstranit vystupenie</h4>
                <?php
                echo "<table>";
                foreach ($podiumArray as $podium) {
                    ?>
                    <form action="../delete.php?type=VYSTUPENIE&id=<?php echo $podium->getID();?>&redirect=<?php echo $festival->getID();?>" method="post" name="del_vystupenie"> <?php
                    echo "<tr><td>".$podium->getNazov($pdo)."</td>";
                    $vystupenia = $podium->getVystupenia($pdo);
                    echo "<td><select name='interpret_vystu'>";
                    foreach ($vystupenia as $vystupenie) {
                        $interpret = new Interpret();
                        if ($interpret->initExistingInterpret($pdo,$vystupenie[0]) == -1){
                            throw new exception("interpreta sa nepodarilo najst");
                        }
                        $interpret_meno = $interpret->getNazov($pdo);
                        echo "<option value='".$interpret->getID()."'>".$podium->getNazov($pdo) ."/".
                            $interpret->getNazov($pdo)."/".$podium->getCas_vystupenia($pdo,$interpret->getID())."</option>";
                    } ?>
                    </select></td>
                    <td><button type="submit" id="add-podium">Odstranit vystupenie</button></td>
                    </tr>
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
