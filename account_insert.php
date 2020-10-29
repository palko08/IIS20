<?php
require "common.php";
require "services.php";
make_header();
?>
<br><br>
<h1>Vytvorit novy ucet</h1>

<?php
$serv = new AccountService();

$newperson = array(
	'meno' => $_POST['meno'],
	'email' => $_POST['email'],
    'login' => $_POST['login'],
    'heslo' => $_POST['password']
);

$error = $serv->addAccount($newperson);
 if ($error)
 {
 	echo '<p>Ucet bol vytvoreny.</p>';
 }
 else 
 {
 	echo '<p>Ucet sa nepodarilo vyrvorit.</p>';
 }
?>
<p><a href="index.php">Spat na domovsku stranku</a></p>
<?php
make_footer();
?>