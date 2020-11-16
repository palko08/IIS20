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


$festival = new Festival();
$error = $festival->createNewFestival($pdo,$nazov,$kapacita, $datum_od, $datum_do,$cena,$adresa);
if ($error == -1)
{
    throw new Exception("Ucet sa nepodarilo vytvorit");
}

header("Location: /admin.php");
die;
?>