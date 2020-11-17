<?php
require_once "services.php";

$serv = new AccountService();

$newperson = array(
	'meno' => $_POST['meno'],
	'email' => $_POST['email'],
    'login' => $_POST['login'],
    'heslo' => $_POST['password']
);

$error = $serv->addAccount($newperson);
 if (!$error)
 {
     throw new Exception("Ucet sa nepodarilo vytvorit");
 }
header("Location: /signin.php");
die;
?>