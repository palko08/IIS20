<?php
require_once 'connect_db.php';
require_once 'services.php';
require_once 'classFestival.php';
require_once 'classInterpret.php';
require_once 'classVstupenka.php';
require_once 'classPodium.php';

$id = '';
$type = $_GET['type'];
$pdo = connect_db();


if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
if (empty($id)) {
    throw new Exception('ID je prazdne');
}

switch ($type) {
    case 'USER':
        $account = new AccountService();
        if ($account->deleteAccount($id) == FALSE){
            throw new Exception('Problem pri odstranovani uzivatela');
        }
        break;
    case 'FESTIVAL':
        $festival = new Festival();
        if($festival->initExistingFestival($pdo, $id) == -1){
            throw new Exception('nenasiel sa festival s danym id.');
        }
        if ($festival->deleteFestival($pdo)){
            throw new Exception('Problem pri odstranovani festivalu');
        }
        break;
    case 'INTERPRET':
        $interpret = new Interpret();
        if($interpret->initExistingInterpret($pdo, $id) == -1){
            throw new Exception('nenasiel sa interpret s danym id.');
        }
        if ($interpret->deleteInterpret($pdo)){
            throw new Exception('Problem pri odstranovani interpreta');
        }
        break;
    case 'TICKET':
        $vstupenka = new Vstupenka();
        if($vstupenka->initExistingVstupenka($pdo, $id) == -1){
            throw new Exception('nenasla sa vstupenka s danym id.');
        }
        if ($vstupenka->deleteVstupenka($pdo)){
            throw new Exception('Problem pri odstranovani vstupenkya');
        }
        header("Location: cart.php");
        die;

    case 'VYSTUPENIE':
        $podium = new Podium();
        if($podium->initExistingPodium($pdo, $id) == -1){
            throw new Exception('nenaslo sa podium s danym id.');
        }
        $interpret = new Interpret();
        if($interpret->initExistingInterpret($pdo, $_POST['interpret_vystu']) == -1){
            throw new Exception('nenaslo sa interpret s danym id.');
        }

        if ($interpret->deleteVystupenie($pdo, $podium->getID()) == -1){
            throw new Exception("epodarilo sa odstranit vystupenei");
        }
        header("Location: view/create_lineup.php?id=".$_GET['redirect']);
        die;
}

header("Location: admin.php");
die;