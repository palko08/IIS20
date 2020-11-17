<?php
require_once 'connect_db.php';
require 'services.php';

$id = '';
$login = '';
$pdo = connect_db();

if (!empty($_GET['login'])) {
    $login = $_GET['login'];
}
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}

if (empty($login)) {
    throw new Exception('login je prazdne');
}
if (empty($id)) {
    throw new Exception('id je prazdne');
}

$stmt = $pdo->prepare('UPDATE Registrovany SET email = ?, login = ?, heslo = ?, level_opravnenia = ? WHERE login = ?');
$stmt->execute([$_POST['email'],$_POST['login'],$_POST['password'],$_POST['opravnenie'],$login]);

$stmt = $pdo->prepare('UPDATE Clovek SET meno = ? WHERE clovek_id = ?');
$stmt->execute([$_POST['name'],$id]);

header("Location: /admin.php");
die;
