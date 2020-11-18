<?php
require_once 'connect_db.php';
require 'services.php';
require "classRegistrovany.php";
require "classClovek.php";

$id = '';
$login = '';
$pdo = connect_db();
$registrovany = new Registrovany();
$clovek = new Clovek();

if (!empty($_GET['login'])) {
    $login = $_GET['login'];
}
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}

$registrovany->initExistingRegistrovany($pdo,$id);
$clovek->initExistingClovek($pdo,$id);

if (empty($login)) {
    throw new Exception('login je prazdne');
}
if (empty($id)) {
    throw new Exception('id je prazdne');
}

if ($_POST['email'] != ''){
    $registrovany->setEmail($pdo,$_POST['email']);
}

if ($_POST['login'] != ''){
    $registrovany->setLogin($pdo,$_POST['login']);
}

if ($_POST['password'] != ''){
    $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $registrovany->setHeslo($pdo,$pwd);
}

if ($_POST['opravnenie'] != ''){
    $registrovany->setLevel_opravnenia($pdo,$_POST['opravnenie']);
}

if ($_POST['name'] != ''){
    $clovek->setMeno($pdo,$_POST['name']);
}

header("Location: /admin.php");
die;
