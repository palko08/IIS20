<?php
require "classVstupenka.php";
require_once ("classFestival.php");
require_once "classNeregistrovany.php";
require_once "classRegistrovany.php";
require_once "connect_db.php";
$pdo = connect_db();
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
?>

<table class="table">
    <thead>
    <h1>Vstupenky</h1>
    <tr>
        <th>ID</th>
        <th>email</th>
        <th>Stav</th>
        <th></th>
        <th>Cena</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($tickets as $ticket){
    ?>
    <form name="change_ticket" method="post" action="../admin.php">
    <tr>
        <td>
            <a class="no_color_change_link" id="ticket" href="../festival_page.php?id=<?php echo $ticket->getFestival_ID($pdo);?>"><?php echo $ticket->getID();?></a>
        </td>
        <td>
            <a class="no_color_change_link" id="ticket_email"><?php echo get_email($ticket,$pdo); ?></a>
        </td>
        <td>
            <a class="no_color_change_link" id="stav"><?php echo $ticket->getStav($pdo); ?></a>
        </td>
        <td>
            <button type="button" id="align-right" class="btn btn-info"> Potvrdiť </button>
            <button type="button" id="align-right" class="btn btn-danger" onclick="location.href='delete.php?type=TICKET&id=<?php echo $ticket->getID();?>'"> Stornovať </button>
        </td>
        <td>
            <a class="no_color_change_link" id="cena"><?php echo get_cena($ticket,$pdo); ?></a></td>
         <td>   <button type="button" id="align-right" class="btn btn-primary"> Vydať </button>
        </td>
    </tr>
        <?php
        }
        ?>
    </form>
    </tbody>
</table>

<?php
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

function change_stav($ticket, $pdo, $stav){
        if ($ticket->setStav($pdo,$stav)){
            throw new Exception('Problem pri odstranovani vstupenkz');
        }
}
?>

