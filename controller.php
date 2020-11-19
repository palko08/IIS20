<?php
require_once "classZaner.php";
require_once "classFestival.php";
require_once "classPodium.php";
require_once "classInterpret.php";
require_once "classClen.php";
require_once "classVstupenka.php";
require_once "classNeregistrovany.php";
require_once "classRegistrovany.php";

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

function get_vystupenia($pdo,$obj){

    $vystupenia = $obj->getVystupenia($pdo);
    foreach ($vystupenia as $row) {
        $podium = new Podium();
        if ($podium->initExistingPodium($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }

        $festival = new Festival();
        $id = $podium->getFestival_ID($pdo);

        if ($podium->initExistingPodium($pdo, $id) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }

        $datum = date_parse_from_format('Y-m-d H:i:s', $podium->getCas_vystupenia($pdo, $obj->getID()));
        echo "<tr><td>" . $datum['day'] . "." . $datum['month'] . "." . $datum['year'] . "</td>";
        echo "<td>" . $festival->getNazov($pdo) . "</td>";
        echo "<td>" . $podium->getNazov($pdo) . "</td>";
        echo "<td>" . $datum['hour'] . "." . $datum['minute']."0". "</td></tr>";

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

function make_interprets_festivals($array, $pdo){

    if ($array[0] != NULL) {
        foreach ($array as $obj) {
            if ($_GET['search'] != NULL) {
                if (strstr($obj->getNazov($pdo), $_GET['search']) != FALSE) {
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
function make_Interpret($interpret, $pdo){
    echo '<div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                    <a href="interpret_page.php?id='.$interpret->getID().'">
                    <div class="thumbnail">
					<img src="'.$interpret->getLogo($pdo).'" alt="'.$interpret->getNazov($pdo).'">
					<div class="text-center" style="margin-top:5px"><strong>'.$interpret->getNazov($pdo).'</strong></div>
					</div>
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
?>