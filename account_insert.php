<?php
require_once "services.php";
require_once "classRegistrovany.php";
require_once "classClovek.php";
require_once "connect_db.php";
$pdo = connect_db();

$serv = new AccountService();

$newperson = array(
	'meno' => $_POST['meno'],
	'email' => $_POST['email'],
    'login' => $_POST['login'],
    'heslo' => $_POST['password']
);
$opravnenie = $_POST['opravnenie'];

$error = $serv->addAccount($newperson);
if ($_GET['type'] == 'admin'){
    $person = $serv->getAccount($newperson['login']);
    $registrovany = new Registrovany();
    $clovek = new Clovek();

    if ($registrovany->initExistingRegistrovany($pdo, $person['registrovany_ID']) == -1) {
        throw new Exception("Nepodarilo sa najst Registrovaneho");
    }
    if ($clovek->initExistingClovek($pdo, $person['registrovany_ID']) == -1) {
        throw new Exception("Nepodarilo sa najst Cloveka");
    }
    $registrovany->setLevel_opravnenia($pdo,$opravnenie);
}
else {
    if ($error == 2) {
        header("Location: register.php");
        die;
    }
    if ($error == FALSE) {
        throw new Exception("Ucet sa nepodarilo vytvorit");
    } else {
        session_start();
        $_SESSION['user'] = $_POST['login'];
    }

    header("Location: profile.php");
}
die;
?>
