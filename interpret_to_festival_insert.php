<?php
require_once "classInterpret.php";
require_once "classFestival.php";
require_once "connect_db.php";

$pdo = connect_db();

$interpret_id = $_POST['interpret'];
$festival_id = $_POST['festival'];

if (!empty($interpret_id) || !empty($festival_id)){
    $interpret = new Interpret();
    $festival = new Festival();

    if($festival->initExistingFestival($pdo, $festival_id) == -1) {
        throw new Exception("festival nenajdeny");
    }

    if ($interpret->initExistingInterpret($pdo, $interpret_id) == -1) {
        throw new Exception("interpet nenajdeni");
    }
    //TODO
}