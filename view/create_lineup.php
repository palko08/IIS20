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
        <h4>VYTVORIŤ ROZPIS</h4>
        <form action="../create_lineup.php?id=<?php echo $_GET['id'] ?>" class="add_podium" method="post">
        <input name="pocet" type="number" min=0 placeholder="Počet podií">
        <label for="lineup_date">Den</label>
        <input name="datum" type="date" id="lineup_date">
        <label for="lineup_time_from">Casovy interval od:</label>
        <input name="datum_od" type="time" id="lineup_time_from">
        <label for="lineup_time_to">do:</label>
        <input name="datum_do" type="time" id="lineup_time_to">
        <button type="submit" class="btn btn-danger" id="add-podium">Pridat podia</button>
        </form>


        <form action="../rozpis_insert.php?id=<?php echo $_GET['id'] ?>" class="add_timeslots" method="post">
            <b name="den">21.11.2020</b>
            <table class="borders" id="lineup-table">
                <thead>
                <tr>
                    <th class="borders">podium/cas</th>
                    <th class="borders">18:00</th>
                    <th class="borders">19:00</th>
                    <th class="borders">20:00</th>
                    <th class="borders">21:00</th>
                    <th class="borders">22:00</th>
                    <th class="borders">23:00</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="borders"><b>PODIUM 1</b></td>
                    <td>
                        <select name="select_interprets_timeslots1">
                            <?php
                            foreach ($interpretArray as $interpret){
                                echo '<option value="'.$interpret->getID($pdo).'">'.$interpret->getNazov($pdo).'</option>';
                            }
                            ?>
                            <option value="">none</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots2">
                            <?php
                            foreach ($interpretArray as $interpret){
                                echo '<option value="'.$interpret->getID($pdo).'">'.$interpret->getNazov($pdo).'</option>';
                            }
                            ?>
                            <option value="">none</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots3">
                            <?php
                            foreach ($interpretArray as $interpret){
                                echo '<option value="'.$interpret->getID($pdo).'">'.$interpret->getNazov($pdo).'</option>';
                            }
                            ?>
                            <option value="">none</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots4">
                            <?php
                            foreach ($interpretArray as $interpret){
                                echo '<option value="'.$interpret->getID($pdo).'">'.$interpret->getNazov($pdo).'</option>';
                            }
                            ?>
                            <option value="">none</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots5">
                            <?php
                            foreach ($interpretArray as $interpret){
                                echo '<option value="'.$interpret->getID($pdo).'">'.$interpret->getNazov($pdo).'</option>';
                            }
                            ?>
                            <option value="">none</option>
                        </select>
                    </td>
                    <td>
                        <select name="select_interprets_timeslots6">
                            <?php
                            foreach ($interpretArray as $interpret){
                                echo '<option value="'.$interpret->getID($pdo).'">'.$interpret->getNazov($pdo).'</option>';
                            }
                            ?>
                            <option value="">none</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <?php
                createDays($pdo,$interpretArray,$podiumArray,$datumOd,$datumDo);
            ?>
            <button class="btn btn-success" id="confirm-lineup">Potvrdiť rozpis</button>
            <button type="submit" class="btn btn-danger" id="remove-lineup">Zrušiť</button>
        </form>
    </div>
</div>