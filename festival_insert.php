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
$hodnotenie = '';
$popis = '';

$festival = new Festival();
$error = $festival->createNewFestival($pdo,$nazov,$kapacita, $datum_od, $datum_do,$cena,$adresa);
if ($error == -1)
{
    throw new Exception("Ucet sa nepodarilo vytvorit");
}
$id = $festival->getID();
if (!(empty($_POST['popis']))) {
    $popis = $_POST['popis'];
    $error = $festival->setPopis($pdo, $popis);
    if ($error == 1) {
        throw new Exception("popis sa neda pridat");
    }
}

if (!(empty($_POST['hodnotenie']))) {
    $popis = $_POST['hodnotenie'];
    $error = $festival->setHodnotenie($pdo, $hodnotenie);
    if ($error == 1) {
        throw new Exception("hodnotenie sa neda pridat");
    }
}

header("Location: /admin.php");
die;
?>