 <?php
require "../classInterpret.php";
require "../classFestival.php";
require_once "../connect_db.php";
require_once "../controller.php";

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
                </thead>';
                foreach ($podiumArray as $podium) {
                echo '
                <tbody>
                <tr>
                    <td class="borders"><b>'.$podium->getNazov($pdo).'</b></td>';
                    for ($k = 0; $k < $cnt; $k++) {
                    echo '
                    <td>
                        <select name="select_interprets_timeslots'.$k.'">
                            ';
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
                                echo '<option value="'.$interpret->getID($pdo).'">'.$interpret->getNazov($pdo).'</option>';
                            }
                            else {
                                echo '<option value="">none</option>';
                            }
                            foreach ($interpretArray as $interpret){
                                echo '<option value="'.$interpret->getID($pdo).'">'.$interpret->getNazov($pdo).'</option>';
                            }
                            echo '
                            <option value="">none</option>
                        </select>
                    </td>';
                    }
                    echo '
                </tr>
                </tbody>';
            }
            echo '
            </table>
    ';
    }
}

$pdo = connect_db();
$interpret = new Interpret();
$festival = new Festival();
$interpretArray = getInterpretsForFestival($pdo, $_GET['id']);
$podiumArray = getPodiaForFestival($pdo, $_GET['id']);
$festival->initExistingFestival($pdo,$_GET['id']);
$datumOd = date_parse_from_format('Y-m-d H:i:s', $festival->getDatum_Od($pdo));
$datumDo = date_parse_from_format('Y-m-d H:i:s', $festival->getDatum_Do($pdo));
?>
<div class="create_lineup">
    <div class="centering">
        <h4>Pridat podia</h4>
        <form action="../update_festivals.php?id=<?php echo $_GET['id'];?>" method="post" name="update_festival">
        <input name="podium_add" type="text" placeholder="Názov">
        <button type="submit" class="btn btn-danger" id="add-podium">Pridat podium</button>
        </form>
        <h4>VYTVORIŤ ROZPIS</h4>
        <form action="../rozpis_insert.php?id=<?php echo $_GET['id'] ?>" class="add_timeslots" method="post">
            <?php
                createDays($pdo,$interpretArray,$podiumArray,$datumOd,$datumDo);
            ?>
            <button class="btn btn-success" id="confirm-lineup">Potvrdiť rozpis</button>
            <button type="submit" class="btn btn-danger" id="remove-lineup">Zrušiť</button>
        </form>
    </div>
</div>

