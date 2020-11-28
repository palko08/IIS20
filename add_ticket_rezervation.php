<?php
require "services.php";
require_once "classVstupenka.php";
require_once 'connect_db.php';
require_once 'classNeregistrovany.php';
require_once 'classClovek.php';
require "common.php";

$pdo = connect_db();
$serv = new AccountService();
if ($_GET['login'] != NULL){
    $person = $serv->getAccount($_GET['login']);
}
else{
    $person = NULL;
}

$pocet = $_POST['pocet'];

for ($i = 0; $i < $pocet; $i++)
{
$vstupenka = new Vstupenka();
if ($_GET['login'] != ""){
    if ($vstupenka->createNewVstupenka($pdo,$_GET['festival_id'],$person['registrovany_ID'],-1) == -1)
    {
        throw new Exception("Nedokazolo pridat vstupenku");
    }
    if($vstupenka->setStav($pdo, 'v kosiku') == 1){
        throw new Exception("Nedokazalo updatnut stav vstupenky!");
    }
}
else {
    $person = new Clovek();
    if ($person->createNewClovek($pdo,"none") == -1) // zmeni sa neskor
    {
        throw new Exception("Nedokazolo pridat clovek");
    }
    if ($_SESSION['id'] == NULL){
        session_start();
        $_SESSION['id'] = $person->getID();
    }
    $neregistrovany = new Neregistrovany();
    if ($neregistrovany->createNewNeregistrovany($pdo,$person->getID(),"-1") == -1)
    {
        throw new Exception("Nedokazolo pridat neregistrovany");
    }
    if ($vstupenka->createNewVstupenka($pdo,$_GET['festival_id'],-1,$neregistrovany->getID()) == -1)
    {
        throw new Exception("Nedokazolo pridat vstupenku");
    }
    if($vstupenka->setStav($pdo, 'v kosiku') == 1){
        throw new Exception("Nedokazalo updatnut stav vstupenky!");
    }
}
}

header("Location: festivals.php");
die;