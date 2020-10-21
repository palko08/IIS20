<?php
require "common.php";

make_header();
?>

<?php 

$login = $_POST['username'];
$password = $_POST['password'];

if (($login == 'subik' && $password == '123') || ($login == 'admin' && $password == '123')) {
	echo "<br><br><h4>Login successful</h4>";
	$_SESSION['user'] = $login;
	make_header();
}
else {
	echo "<p>Incorrect Login</p>";
}

?>

<a href="profile.php">Účet</a><br>
<a href="#">Vstupenky</a><br>
<a href="index.php">Back to home page</a>
<br><a href="admin.php">Admin Page</a>
<br><br><br>

<?php 
make_footer();
?>