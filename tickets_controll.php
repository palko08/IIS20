<?php
require_once "classVstupenka.php";
require_once ("classFestival.php");
require_once "classNeregistrovany.php";
require_once "classRegistrovany.php";
require_once "connect_db.php";

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