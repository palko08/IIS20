<?php
require "classFestival.php";
require "connect_db.php";
$pdo = connect_db();

$nazov = $_POST['nazov'];
$kapacita = $_POST['kapacita'];
$adresa = $_POST['adresa'];
$datum_od = $_POST['od'];
$datum_do = $_POST['do'];
$cena = $_POST['cena'];
$popis = '';

$festival = new Festival();
$error = $festival->createNewFestival($pdo,$nazov,$kapacita, $datum_od, $datum_do,$cena,$adresa);
if ($error == -1)
{
    throw new Exception("Ucet sa nepodarilo vytvorit");
}

if (!(empty($_POST['popis']))) {
    $popis = $_POST['popis'];
    $id = $festival->getID();
    $error = $festival->setPopis($pdo, $id);
    if ($error == 1) {
        throw new Exception("popis sa neda pridat");
    }
}

header("Location: /admin.php");
die;
?>