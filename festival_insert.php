<?php
require_once "classFestival.php";
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
$obr = '';
$zanre = $_POST['zaner'];

if ($datum_od > $datum_do){
    echo 'Datum od musi byt mensi ako datum do.';
    throw new Exception("Ucet sa nepodarilo vytvorit, datum od musi byt mensi ako datum do.");
}

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

if (!(empty($_POST['obr']))) {
    $popis = $_POST['obr'];
    $error = $festival->setObrazok($pdo, $obr);
    if ($error == 1) {
        throw new Exception("obrazok sa neda pridat");
    }
}

if (!(empty($zanre))) {
    foreach ($zanre as $zaner) {
        $error = $festival->addZaner($pdo, $zaner);
        if ($error == 1) {
            throw new Exception("zaner sa neda pridat");
        }
    }
}


header("Location: admin.php");
die;
?>