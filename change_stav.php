<?php
require_once "classVstupenka.php";
require_once "connect_db.php";

$pdo = connect_db();

$stav = $_GET['stav'];
$id = $_GET['id'];

if (isset($_GET['id'])) {
    $ticket = new Vstupenka();
    $ticket->initExistingVstupenka($pdo,$id);
    $ticket->setStav($pdo,$stav);
}

header("Location: admin.php");
die;
?>