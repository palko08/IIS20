<?php
require "common.php";
require "services.php";

make_header();
?>

<?php 
$serv = new AccountService();

$login = $_POST['username'];
$password = $_POST['password'];

if ($serv->isValidAccount($login, $password)) 
{
	echo "<br><br><h4>Login successful</h4>";
	$_SESSION['user'] = $login;
	make_header();
	echo '<a href="profile.php">Účet</a><br>
<a href="#">Vstupenky</a><br>
<a href="index.php">Back to home page</a>
<br><a href="admin.php">Admin Page</a>
<br><br><br>';
}
else 
{
	echo "<br><br><br><p>Incorrect Login</p>";
	echo '<a href="index.php">Back to home page</a>';
}

make_footer();
?>