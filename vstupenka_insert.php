<?php
require_once "classVstupenka.php";
require "connect_db.php";

$pdo = connect_db();
$festival_ID = $_POST['festival_ID'];
$registrovany_ID = $_POST['registrovany_ID'];
$neregistrovany_ID = $_POST['neregistrovany_ID'];
$stav = '';

$vstupenka = new Vstupenka();
$error = $vstupenka->createNewVstupenka($pdo,$festival_ID,$registrovany_ID,$neregistrovany_ID);
if ($error == -1)
{
    throw new Exception("Vstupenku sa nepodarilo vytvorit");
}

$id = $vstupenka->getId();
if (!(empty($_POST['stav']))) {
    $stav = $_POST['stav'];
    $error = $vstupenka->setStav($pdo, $stav);
    if ($error == 1) {
        throw new Exception("stav sa neda pridat");
    }
}

header("Location: admin.php");
die;
?>
