<?php
require "../services.php";
require "../classVstupenka.php";
require_once '../connect_db.php';

$pdo = connect_db();
$serv = new AccountService();
$person = $serv->getAccount($_SESSION['user']);

//for ($i = 0; i < $_POST['qty']; $i++)
//{
    $vstupenka = new Vstupenka();
    if ($vstupenka->createNewVstupenka($pdo,$_GET['festival_id'],$person['registrovany_ID'],-1) == -1)
    {
        throw new Exception("Nedokazolo pridat vstupenku");
    }
//}

header("Location: /festivals.php");
die;