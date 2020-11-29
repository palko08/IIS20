<?php
require_once 'connect_db.php';
require_once 'services.php';
require 'classRegistrovany.php';
require 'classClovek.php';

session_start();
$pdo = connect_db();
$serv = new AccountService();
$person = $serv->getAccount($_SESSION['user']);
$registrovany = new Registrovany();
$clovek = new Clovek();

if ($registrovany->initExistingRegistrovany($pdo, $person['registrovany_ID']) == -1) {
	throw new Exception("Nepodarilo sa najst Registrovaneho");
}
if ($clovek->initExistingClovek($pdo, $person['registrovany_ID']) == -1) {
	throw new Exception("Nepodarilo sa najst Cloveka");
}


if ($_POST['login'] != '') {
	if ($registrovany->setLogin($pdo, $_POST['login']) == 1) {
		throw new Exception("Nepodarilo sa pridat login");
	}
	$_SESSION['user'] = $_POST['login'];
}

if ($_POST['name'] != '') {
	if ($clovek->setMeno($pdo, $_POST['name']) == 1) {
		throw new Exception("Nepodarilo sa pridat meno");
	}
}

if ($_POST['email'] != '') {
	if ($registrovany->setEmail($pdo, $_POST['email']) == 1) {
		throw new Exception("Nepodarilo sa pridat email");
	}
}

if ($_POST['password'] != '') {
	if ($registrovany->setHeslo($pdo, $_POST['password']) == 1) {
		throw new Exception("Nepodarilo sa pridat heslo");
	}
}

header("Location: profile.php");
die;
?>