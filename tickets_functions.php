<?php
require_once "classVstupenka.php";
require_once "connect_db.php";
$pdo = connect_db();

function changeStav($ticket_id,$stav,$pdo) {
    $ticket = new Vstupenka();
    $ticket->initExistingVstupenka($pdo,$ticket_id);
    $ticket->setStav($pdo,$stav);
}

$func = $_GET['func'];
$stav = $_GET['stav'];
$id = $_GET['id'];

if ($func == "stav") {
    changeStav($id,$stav,$pdo);
}

header("Location: /admin.php");
die;
?>