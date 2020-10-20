<?php
require "common.php";

make_header();
?>

<h1>Login</h1>

<?php 

$login = $_POST['username'];
$password = $_POST['password'];

if (($login == 'subik' && $password == '123') || ($login == 'admin' && $password == '123')) {
	echo "<p>Login successful</p>";
	$_SESSION['user'] = $login;
}
else {
	echo "<p>Incorrect Login</p>";
}

?>

<a href="index.php">Back to home page</a>
<br><a href="admin.php">Admin Page</a>

<?php 
make_footer();
?>