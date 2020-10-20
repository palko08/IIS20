<?php
require "common.php";

unset($_SESSION['user']);
redirect('index.php');

make_header();
?>

<h1>Logout</h1>

<a href="index.php">Back</a>

<?php
make_footer();
?>