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
if($error == 2){
	header("Location: register.php");
	die;
}
 if ($error == FALSE)
 {
     throw new Exception("Ucet sa nepodarilo vytvorit");
 }
 else {
 	session_start();
	$_SESSION['user'] = $_POST['login'];
 }

header("Location: profile.php");
die;
?>
