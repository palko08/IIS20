<?php
require "common.php";

make_header();

if (isset($_SESSION['user'])) {
 	echo 'Current user: <strong>' . $_SESSION['user'] . '</strong>';
 	echo '<a href="index.php">Back to home page</a>';
 	echo '<p><a href="admin.php">Go to admin page</a>';
 	echo '<p><a href="logout.php">Logout</a>';
 }
?>

<div>
	
</div>

<?php
	make_footer();
?>