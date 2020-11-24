<?php
require_once "classVstupenka.php";
require_once "connect_db.php";
require_once "controller.php";

$pdo = connect_db();
$tickets = get_vstupenky($pdo);
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
    <form name="change_ticket" method="post" action="admin.php">
    <tr>
        <td>
            <a class="no_color_change_link" id="ticket" href="../festival_page.php?id=<?php echo $ticket->getFestival_ID($pdo);?>"><?php echo $ticket->getID();?></a>
        </td>
        <td>
            <a class="no_color_change_link" id="ticket_email"><?php echo get_email($ticket,$pdo); ?></a>
        </td>
        <td>
            <a class="no_color_change_link" id="stav"><?php echo $ticket->getStav($pdo); ?></a>
            <p style="color: red">
                <?php check_tickets_limit($pdo,$ticket); ?>
            </p>
        </td>
        <td>
            <a href="change_stav.php?stav=potvrdena&id=<?php echo $ticket->getID(); ?>"><button type="button" id="align-right" class="btn btn-info"> Potvrdiť </button></a>
            <a href="change_stav.php?stav=stornovana&id=<?php echo $ticket->getID(); ?>"><button type="button" id="align-right" class="btn btn-danger"> Stornovať </button></a>
        </td>
        <td>
            <a class="no_color_change_link" id="cena"><?php echo get_cena($ticket,$pdo); ?></a></td>
         <td>  <a href="change_stav.php?stav=vydana&id=<?php echo $ticket->getID(); ?>"><button type="button" id="align-right" class="btn btn-primary"> Vydať </button></>
        </td>
    </tr>
        <?php
        }
        ?>
    </form>
    </tbody>
</table>



