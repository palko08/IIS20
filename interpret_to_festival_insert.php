<?php
require_once "classInterpret.php";
require_once "classFestival.php";
require_once "connect_db.php";

$pdo = connect_db();

$interpret_id = $_POST['interpret'];
$festival_id = $_GET['id'];
$podium_id = $_POST['podium'];

if (!empty($interpret_id) || !empty($festival_id)){
    $interpret = new Interpret();
    $festival = new Festival();

    if($festival->initExistingFestival($pdo, $festival_id) == -1) {
        throw new Exception("festival nenajdeny");
    }

    $datumOd = $festival->getDatum_Od($pdo);
    $datumDo = $festival->getDatum_Do($pdo);

    if ($_POST['timeslot'] < $datumOd || $_POST['timeslot'] > $datumDo){
        throw new Exception("Datum je mimo zadany cas.");
    }

    if ($interpret->initExistingInterpret($pdo, $interpret_id) == -1) {
        throw new Exception("interpet nenajdeni");
    }

    $interpret->addVystupenie($pdo, $podium_id, $_POST['timeslot']);
}
header("Location: view/create_lineup.php?id=".$festival_id);
die;