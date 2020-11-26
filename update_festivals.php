<?php
require_once 'connect_db.php';
require_once "classFestival.php";
require_once "classPodium.php";

$pdo = connect_db();
$festival = new Festival();
$id =  '';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}

$festival->initExistingFestival($pdo, $id);

if ($_POST['festival_name'] != "") {
    $festival->setNazov($pdo,$_POST['festival_name']);
}

if ($_POST['festival_address'] != "") {
    $festival->setAdresa($pdo,$_POST['festival_address']);
}

if ($_POST['festival_date_from'] != "") {
    $festival->setDatum_Od($pdo,$_POST['festival_date_from']);
}

if ($_POST['festival_date_to'] != "") {
    $festival->setDatum_Do($pdo,$_POST['festival_date_to']);
}

if ($_POST['festival_capacity'] != "") {
    $festival->setKapacita($pdo,$_POST['festival_capacity']);
}

if ($_POST['festival_price'] != "") {
    $festival->setCena($pdo,$_POST['festival_price']);
}

if ($_POST['podium_add'] != "") {
    $podium = new Podium();
    $podium->createNewPodium($pdo,$id,$_POST['podium_add']);
    header("Location: view/create_lineup.php?id=".$id);
    die;
}

header("Location: admin.php");
die;