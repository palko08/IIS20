<?php
require_once 'connect_db.php';
require 'services.php';

$id = '';
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
}
if (empty($id)) {
    throw new Exception('ID je prazdne');
}
$account = new AccountService();
if ($account->deleteAccount($id) == FALSE){
    throw new Exception('Problem pri odstranovani uzivatela');
}

header("Location: /admin.php");
die;