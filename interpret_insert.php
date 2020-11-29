<?php
require "classInterpret.php";
require_once "connect_db.php";
$pdo = connect_db();

$nazov = $_POST['nazov'];
$clenovia = $_POST['clenovia'];
$hodnotenie = '';
$obr = '';
$zanre = $_POST['zaner'];

$interpret = new Interpret();
$error = $interpret ->createNewInterpret($pdo,$nazov);
if ($error == -1)
{
    throw new Exception("Interpreta sa nepodarilo vytvorit");
}
$id = $interpret->getID();

if (!(empty($_POST['hodnotenie']))) {
    $popis = $_POST['hodnotenie'];
    $error = $interpret->setHodnotenie($pdo, $hodnotenie);
    if ($error == 1) {
        throw new Exception("hodnotenie sa neda pridat");
    }
}

if (!(empty($_POST['obr']))) {
    $popis = $_POST['obr'];
    $error = $interpret->setObrazok($pdo, $obr);
    if ($error == 1) {
        throw new Exception("obrazok sa neda pridat");
    }
}

if (!(empty($zanre))) {
    foreach ($zanre as $zaner) {
        $error = $interpret->addZaner($pdo, $zaner);
        if ($error == 1) {
            throw new Exception("obrazok sa neda pridat" . var_dump($zanre));
        }
    }
}

header("Location: admin.php");
die;
?>
