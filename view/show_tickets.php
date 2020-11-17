<?php
require "classVstupenka.php";
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
    <form name="change_ticket" method="post" action="">
    <tr>
        <td>
            <a class="no_color_change_link" id="ticket" href="../festival_page.php?id=<?php echo $ticket->getFestivalID();?>"><?php echo $ticket->getID()?></a>
        </td>
        <td>
            <a class="no_color_change_link" id="ticket_email"><?php echo get_email($ticket,$pdo); ?></a>
        </td>
        <td>
            <a class="no_color_change_link" id="stav"><?php echo $ticket->getStav($pdo); ?></a>
        </td>
        <td>
            <button type="button" id="align-right" class="btn btn-info"> Potvrdiť </button>
            <button type="button" id="align-right" class="btn btn-danger"> Stornovať </button>
        </td>
        <td>
            <a class="no_color_change_link" id="cena">cena</a></td>
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