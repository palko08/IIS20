<?php
require_once 'connect_db.php';
require 'services.php';
require 'classFestival.php';

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
}

header("Location: /admin.php");
die;