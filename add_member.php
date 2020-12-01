<?php
require_once "classInterpret.php";
require_once "classClovek.php";
require_once "classClen.php";
require_once "connect_db.php";

$pdo = connect_db();

$interpret_id = $_POST['interpret'];
$meno = $_POST['meno'];

if (!empty($interpret_id) || !empty($meno)){
    $interpret = new Interpret();
    $clen = new Clen();
    $clovek = new Clovek();

    if($clovek->createNewClovek($pdo, $meno) == -1) {
        throw new Exception("clovek nevytvoreni");
    }

    $clovek_id = $clovek->createNewClovek($pdo, $meno);

    if($clen->createNewClen($pdo, $clovek_id) == -1) {
        throw new Exception("clen nevyvtoreni".$clovek_id);
    }

    if ($interpret->initExistingInterpret($pdo, $interpret_id) == -1) {
        throw new Exception("interpet nenajdeni");
    }

    $interpret->addClen($pdo,$clen->getID());
}
