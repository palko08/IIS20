<?php
require "services.php";
require_once "classVstupenka.php";
require_once 'connect_db.php';
require_once 'classNeregistrovany.php';
require_once 'classClovek.php';
require "common.php";

$pdo = connect_db();
$serv = new AccountService();
$person = $serv->getAccount($_GET['login']);
$pocet = $_POST['pocet'];

for ($i = 0; $i < $pocet; $i++)
{
$vstupenka = new Vstupenka();
if (!empty($person)){
    if ($vstupenka->createNewVstupenka($pdo,$_GET['festival_id'],$person['registrovany_ID'],-1) == -1)
    {
        throw new Exception("Nedokazolo pridat vstupenku");
    }
}
else {
    $person = new Clovek();
    if ($person->createNewClovek($pdo,"none") == -1) // zmeni sa neskor
    {
        throw new Exception("Nedokazolo pridat clovek");
    }
    $neregistrovany = new Neregistrovany();
    if ($neregistrovany->createNewNeregistrovany($pdo,$person->getID(),-1) == -1)
    {
        throw new Exception("Nedokazolo pridat neregistrovany");
    }
    $person = 0;
    if ($vstupenka->createNewVstupenka($pdo,$_GET['festival_id'],$neregistrovany->getID(),-1) == -1)
    {
        throw new Exception("Nedokazolo pridat vstupenku");
    }
}
}

header("Location: /festivals.php");
die;