<?php
require_once 'connect_db.php';
require 'classInterpret.php';

$pdo = connect_db();
$interpret = new Interpret();
$id =  '';

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}

$interpret->initExistingInterpret($pdo,$id);

if ($_POST['meno'] != ''){
    $interpret->setNazov($pdo,$_POST['meno']);
}

if ($_POST['rating'] != ''){
    $interpret->setHodnotenie($pdo,$_POST['rating']);
}

if ($_POST['artist_foto'] != ''){
    $interpret->setLogo($pdo,$_POST['artist_foto']);
}
header("Location: /admin.php");
die;
