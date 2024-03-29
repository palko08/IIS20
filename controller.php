<?php
require_once "classZaner.php";
require_once "classFestival.php";
require_once "classPodium.php";
require_once "classInterpret.php";
require_once "classClen.php";
require_once "classVstupenka.php";
require_once "classNeregistrovany.php";
require_once "classRegistrovany.php";

function getInterpretForTime($pdo, $dateTime, $podium_id){
    $select = $pdo->prepare("SELECT interpret_ID FROM Interpret_vystupuje_na_Podium WHERE cas_vystupenia = ? AND podium_ID = ?");
    $datestr = $dateTime['year']."-".$dateTime['month']."-".$dateTime['day']." ".$dateTime['hour'].":".$dateTime['minute'].":".$dateTime['second'];
    $date = strtotime($datestr);
    $select->execute([date('Y-m-d H:i:s',$date),$podium_id]);
    $id = $select->fetchColumn();

    if ($id == NULL) {
        return NULL;
    }
    else {
        $interpret = new Interpret();
        $interpret->initExistingInterpret($pdo,$id);
        return $interpret;
    }
}

function getPodiaForFestival($pdo, $festival_ID){
    $idSelect = $pdo->prepare("SELECT podium_ID FROM Podium WHERE festival_ID = ?");
    $idSelect->execute([$festival_ID]);
    $results = $idSelect->fetchAll();
    $array = array();
    foreach ($results as $row) {
        $object = new Podium();
        if ($object->initExistingPodium($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        $array[] = $object;
    }
    return $array;

}

function getInterpretsForFestival($pdo, $festival_ID){
    $arrayPodia = getPodiaForFestival($pdo, $festival_ID);
    $array = array();
    foreach ($arrayPodia as $podium) {
        $idSelect = $pdo->prepare("SELECT interpret_ID FROM Interpret_vystupuje_na_Podium WHERE podium_ID = ?");
        $idSelect->execute([$podium->getID()]);
        $results = $idSelect->fetchAll();
        foreach ($results as $row) {
            $object = new Interpret();
            if ($object->initExistingInterpret($pdo, $row[0]) == -1) {
                echo "nenasli sme v datbazke dany row<br>";
            }
            if (!array_search($object, $array)) {
                $array[] = $object;
            }
        }
    }
    return $array;
}

function get_user_vstupenky($pdo,$id){
    $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE registrovany_ID = ? AND stav = ?");
    $idSelect->execute([$id, 'v kosiku']);
    $results = $idSelect->fetchAll();
    $array = array();
    foreach ($results as $row) {
        $object = new Vstupenka();
        if ($object->initExistingVstupenka($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        $array[] = $object;
    }
    return $array;
}

function get_nouser_vstupenky($pdo,$id){
    $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE neregistrovany_ID = ? AND stav = ?");
    $idSelect->execute([$id, 'v kosiku']);
    $results = $idSelect->fetchAll();
    $array = array();
    foreach ($results as $row) {
        $object = new Vstupenka();
        if ($object->initExistingVstupenka($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        $array[] = $object;
    }
    return $array;
}

function get_user_vstupenky_all($pdo,$id){
    $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE registrovany_ID = ?");
    $idSelect->execute([$id]);
    $results = $idSelect->fetchAll();
    $array = array();
    foreach ($results as $row) {
        $object = new Vstupenka();
        if ($object->initExistingVstupenka($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        $array[] = $object;
    }
    return $array;
}

function getVstupenky($pdo, $registrovany_ID, $neregistrovany_ID, $festival_ID){
    if($festival_ID == -1){
        if($registrovany_ID != -1 && $neregistrovany_ID == -1){
            $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE registrovany_ID = ? AND stav = ?");
            $idSelect->execute([$registrovany_ID,'rezervovana']);
        }else if($registrovany_ID == -1 && $neregistrovany_ID != -1){
            $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE neregistrovany_ID = ? AND stav = ?");
            $idSelect->execute([$neregistrovany_ID,'rezervovana']);
        }else{
            $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka");
            $idSelect->execute();
        }
    }else{
        if($registrovany_ID != -1 && $neregistrovany_ID == -1){
            $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE registrovany_ID = ? AND festival_ID = ? AND stav = ?");
            $idSelect->execute([$registrovany_ID, $festival_ID,'rezervovana']);
        }else if($registrovany_ID == -1 && $neregistrovany_ID != -1){
            $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE neregistrovany_ID = ? AND festival_ID = ? AND stav = ?");
            $idSelect->execute([$neregistrovany_ID, $festival_ID,'rezervovana']);
        }else{
            $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka WHERE festival_ID = ? AND stav = ?");
            $idSelect->execute([$festival_ID,'rezervovana']);
        }
    }
    return $idSelect->rowCount();
}

function check_tickets_limit($pdo,$ticket){

    $festival_id = $ticket->getFestival_ID($pdo);
    $reg_id = $ticket->getRegistrovany_ID($pdo);
    $nereg_id = $ticket->getNeregistrovany_ID($pdo);

    if (empty($festival_id)) {
        $festival_id = -1;
    }
    if (empty($reg_id )) {
        $reg_id  = -1;
    }
    if (empty($nereg_id)) {
        $nereg_id = -1;
    }

    $count = getVstupenky($pdo,$reg_id,$nereg_id,$festival_id);

    if ($count > 10) {
        echo "max limit prekroceny. Pocet vstupeniek: ".$count;
    }
}

function get_vstupenky($pdo){
    $idSelect = $pdo->prepare("SELECT vstupenka_ID FROM Vstupenka");
    $idSelect->execute();

    $results = $idSelect->fetchAll();

    $tickets = array();

    foreach($results as $row) {
        $ticket = new Vstupenka();
        if($ticket->initExistingVstupenka($pdo, $row[0]) == -1){
            echo "nenasli sme v databazke dany row<br>";
        }
        $tickets[] = $ticket;
    }
    return $tickets;
}

function get_zanre($pdo){
    $id = $pdo->prepare("SELECT zaner_ID FROM Zaner");
    $id->execute();
    $results = $id->fetchAll();
    $array = array();
    foreach ($results as $row) {
        $object = new Zaner();
        if ($object->initExistingZaner($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        $array[] = $object;
    }
    return $array;
}

function get_festivals($pdo)
{
    $idSelect = $pdo->prepare("SELECT festival_ID FROM Festival");
    $idSelect->execute();

    $results = $idSelect->fetchAll();

    $festivals = array();

    foreach ($results as $row) {
        $festival = new Festival();
        if ($festival->initExistingFestival($pdo, $row[0]) == -1) {
            echo "nenasli sme v databazke dany row<br>";
        }
        $festivals[] = $festival;
    }

    return $festivals;
}

function get_interprets($pdo)
{
    $idSelect = $pdo->prepare("SELECT interpret_ID FROM Interpret");
    $idSelect->execute();

    $results = $idSelect->fetchAll();

    $festivals = array();

    foreach ($results as $row) {
        $interpret = new Interpret();
        if ($interpret->initExistingInterpret($pdo, $row[0]) == -1) {
            echo "nenasli sme v databazke dany row<br>";
        }
        $interprets[] = $interpret;
    }

    return $interprets;
}

function print_zanre($obj, $pdo, $style)
{
    $zanre = $obj->getZanre($pdo);
    foreach ($zanre as $row) {
        $zaner = new Zaner();
        if ($zaner->initExistingZaner($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        if ($style == "line")
            echo $zaner->getZaner_nazov($pdo) . " ";
        elseif ($style == "multiple")
            echo "<option value=".$zaner->getID().">".$zaner->getZaner_nazov($pdo)."</option>";
    }
}
function get_interpret_festivals($pdo,$obj){
    $vystupenia = $obj->getVystupenia($pdo);
    $podium = new Podium();
    $festival = new Festival();
    $festivals = array();
    foreach ($vystupenia as $row) {
        if ($podium->initExistingPodium($pdo, $row[0]) == -1) {
            throw new exception ("nenasli sme v datbazke dany row");
        }

        if ($festival->initExistingFestival($pdo, $podium->getFestival_ID($pdo)) == -1) {
            throw new exception ("nenasli sme v datbazke dany row");
        }
        array_push($festivals, $festival->getID());

    }

    return array_unique($festivals);
}

function print_festivals($obj, $pdo)
{
    foreach ($obj as $row) {
        $festival = new Festival();
        if ($festival->initExistingFestival($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        echo "<option value=".$festival->getID().">".$festival->getNazov($pdo)."</option>";
    }
}

function get_vystupenia($pdo,$obj){

    $vystupenia = $obj->getVystupenia($pdo);
    $podium = new Podium();
    $festival = new Festival();
    foreach ($vystupenia as $row) {
        if ($podium->initExistingPodium($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }

        if ($festival->initExistingFestival($pdo, $podium->getFestival_ID($pdo)) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }

        $datum = date_parse_from_format('Y-m-d H:i:s', $podium->getCas_vystupenia($pdo, $obj->getID()));
        echo "<tr><td>" . $datum['day'] . "." . $datum['month'] . "." . $datum['year'] . "</td>";
        echo "<td>" . $festival->getNazov($pdo) . "</td>";
        echo "<td>" . $podium->getNazov($pdo) . "</td>";
        if($datum['minute'] == 0){
            echo "<td>" . $datum['hour'] . "." . $datum['minute']."0". "</td></tr>";
        }else{
            echo "<td>" . $datum['hour'] . "." . $datum['minute']. "</td></tr>";
        }
        
    }
}

function get_vystupenia_festival($pdo,$obj){

    $vystupenia = $obj->getPodia($pdo);
    $podium = new Podium();
    foreach ($vystupenia as $row) {

        if ($podium->initExistingPodium($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }

        $interpreti = $obj->getVystupenia($pdo,$row[0]);
        $interpret = new Interpret();

        foreach ($interpreti as $row2) {

            if ($interpret->initExistingInterpret($pdo, $row2[0]) == -1) {
                echo "nenasli sme v datbazke dany row<br>";
            }
    
            $datum = date_parse_from_format('Y-m-d H:i:s', $podium->getCas_vystupenia($pdo, $interpret->getID()));
            echo "<tr><td>" . $interpret->getNazov($pdo) . "</td>";
            echo "<td>" . $podium->getNazov($pdo) . "</td>";
            echo "<td>" . $datum['day'] . "." . $datum['month'] . "." . $datum['year'] . "</td>";
            if($datum['minute'] == 0){
                echo "<td>" . $datum['hour'] . "." . $datum['minute']."0". "</td></tr>";
            }else{
                echo "<td>" . $datum['hour'] . "." . $datum['minute']. "</td></tr>";
            }

        }
        
    }
}

function print_clenov($obj,$pdo){
    $clenovia = $obj->getClenov($pdo);
    foreach ($clenovia as $row){
        $clen = new Clen();
        if ($clen->initExistingClen($pdo,$row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        echo "<h4>".$clen->getClovekMeno($pdo)."</h4>";
    }
}

function make_interprets_festivals($array, $pdo,$search){

    if ($array[0] != NULL) {
        foreach ($array as $obj) {
            if ($search != NULL) {
                if (strstr($obj->getNazov($pdo), $search) != FALSE) {
                    if (get_class($obj) == Interpret::class)
                        make_Interpret($obj, $pdo);
                    else if (get_class($obj) == Festival::class)
                        make_festival($obj,$pdo);
                }
            }
            else{
                if (get_class($obj) == Interpret::class)
                    make_Interpret($obj, $pdo);
                else if (get_class($obj) == Festival::class)
                    make_festival($obj,$pdo);
            }
        }
    }
}

function make_product($pdo, $vstupenka){
    echo '<tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading"><a href="festival_page.php?id='.$vstupenka->getFestival_ID($pdo).'">Vstupenka</a></h4>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            <div class="number-input md-number-input">
                                <input class="quantity" min="0" name="quantity" value="1" type="number">
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>'.get_cena($vstupenka,$pdo).'</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>'.get_cena($vstupenka,$pdo).'</strong></td>
                        <td class="col-sm-1 col-md-1">';
    ?>
    <button type="button" class="btn btn-danger" onclick="location.href='delete.php?type=TICKET&id=<?php echo $vstupenka->getID()?>'" >
        <span class="glyphicon glyphicon-remove"></span> Odstrániť
    </button></td>
    </tr>
    <?php
}

function make_Interpret($interpret, $pdo){
    echo '<div class="col-sm-4">
                    <a href="interpret_page.php?id='.$interpret->getID().'">
                    <div class="thumbnail">
					<img src="'.$interpret->getLogo($pdo).'" alt="'.$interpret->getNazov($pdo).'">
					<div class="text-center" style="margin-top:5px"><strong>'.$interpret->getNazov($pdo).'</strong></div>
					</div>
					</a>
                </div>';
}

function make_festival($festival,$pdo)
{
    echo '<div class="col-sm-4">
        <a href="festival_page.php?id='.$festival->getID().'">
		<div class="thumbnail">
		<img src="'. $festival->getObrazok($pdo) .'" alt="Obrastok">
		<p style="margin-top:5px"><strong>'.$festival->getNazov($pdo).'</strong></p>
		<p>od :'.$festival->getDatum_Od($pdo).'</p>
		<p>do :'.$festival->getDatum_Do($pdo).'</p>
		<button class="btn">Buy Tickets</button>
		</div>
        </a>
	</div>';
}

function make_Vstupenka($pdo,$vstupenka){
    $festival = new Festival();
    $festival->initExistingFestival($pdo,$vstupenka->getFestival_ID($pdo));
    echo '  <tr>
                <td>
                    <a class="no_color_change_link" id="ticket" href="festival_page.php?id='.$vstupenka->getFestival_ID($pdo).'">'.$festival->getNazov($pdo).'</a>
                </td>
                <td>
                    <a class="no_color_change_link" id="stav">'.$vstupenka->getStav($pdo).'</a>
                </td>
                <td>
                    <a class="no_color_change_link" id="cena">'.$festival->getCena($pdo).'</a>
                </td>
            </tr>';
}

function get_cena($ticket,$pdo){
    $festival_id = $ticket->getFestival_ID($pdo);
    $festival = new Festival();
    if ($festival->initExistingFestival($pdo, $festival_id) == -1) {
        echo "festival nenadjeny";
    }
    return $festival->getCena($pdo);
}

function get_email($ticket,$pdo){
    $customer = null;

    if ($ticket->getNeregistrovany_ID($pdo) != NULL) {
        $id_customer = $ticket->getNeregistrovany_ID($pdo);
        $customer = new Neregistrovany();
        if ($customer->initExistingNeregistrovany($pdo, $id_customer) == -1){
            echo "nenasli sme v databazke dany row<br>";
        }
    }
    elseif ($ticket->getRegistrovany_ID($pdo) != NULL) {
        $id_customer = $ticket->getRegistrovany_ID($pdo);
        $customer = new Registrovany();
        if ($customer->initExistingRegistrovany($pdo, $id_customer) == -1){
            echo "nenasli sme v databazke dany row<br>";
        }
    }

    return $customer->getEmail($pdo);
}

function deleteInterpretForTime($pdo, $dateTime, $podium_id){
    if (getInterpretForTime($pdo,$dateTime,$podium_id) != NULL) {
        try {
            $datestr = $dateTime['year'] . "-" . $dateTime['month'] . "-" . $dateTime['day'] . " " . $dateTime['hour'] . ":" . $dateTime['minute'] . ":" . $dateTime['second'];
            $date = strtotime($datestr);
            $stmt = $pdo->prepare('DELETE FROM Interpret_vystupuje_na_Podium WHERE podium_ID = ? AND cas_vystupenia = ?');
            $stmt->execute([$podium_id,date('Y-m-d H:i:s', $date)]);
        } catch (PDOException $e) {
            echo $e->getMessage() . "<br>";
            return 1;
        }
        return 0;
    }
}

function insertInterpretForTime($pdo, $dateTime, $podium_id, $interpret_id){
    if (deleteInterpretForTime($pdo, $dateTime, $podium_id) == 1){
        return 1;
    }

    try {
        $insert = $pdo->prepare("INSERT INTO Interpret_vystupuje_na_Podium VALUES (?,?,?)");
        $datestr = $dateTime['year'] . "-" . $dateTime['month'] . "-" . $dateTime['day'] . " " . $dateTime['hour'] . ":" . $dateTime['minute'] . ":" . $dateTime['second'];
        $date = strtotime($datestr);
        $insert->execute([$interpret_id, $podium_id, date('Y-m-d H:i:s', $date)]);
    } catch (PDOException $e) {
        echo $e->getMessage() . "<br>";
        return 1;
    }

    return 0;
}

function createDays($pdo,$interpretArray,$podiumArray,$datumOd,$datumDo){
    for ($i = $datumOd['day']; $i <= $datumDo['day']; $i++) {
        $cnt = 0;
        echo '
    <b name="den">'.$i.'.'.$datumOd['month'].'.'.$datumOd['year'].'</b>
            <table class="borders" id="lineup-table">
                <thead>
                <tr class="borders">
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
                <tr class="borders">
                    <td class="borders"><b>'.$podium->getNazov($pdo).'</b></td>';
            for ($k = 0; $k < $cnt; $k++) {
                echo '
                    <td class="borders">    ';
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
function delete_vystupenie($podium,$pdo){
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
    <?php
}
?>