<?php
require "common.php";
require "services.php";

make_header();
?>

<?php 
$serv = new AccountService();

$login = $_POST['username'];
$password = $_POST['password'];
$person = $serv->getAccount($login);
if ($serv->isValidAccount($login, $password)) 
{
	echo "<br><br><h4>Login successful</h4>";
	$_SESSION['user'] = $login;
	make_header();
	echo '<a href="profile.php">Účet</a><br>
<a href="tickets.php">Vstupenky</a><br>
<a href="index.php">Back to home page</a>
<br>';
    if ($person['level_opravnenia'] != 'divak')
    {
        echo '<a href="admin.php">Admin Page</a>';
    }
}
else 
{
	echo "<br><br><br><p>Incorrect Login</p>";
	echo '<a href="index.php">Back to home page</a>';
}

make_footer();
?>