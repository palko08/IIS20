<?php 
	session_start();

	function make_header($title)
	{
	?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta hhtp-equiv="content-type" content="text/html"; charset="utf-8">
			<title><?php echo $title;?></title>
		</head>
		<body>
	<?php
	}

	function make_footer()
	{
	?>
		<footer>&copy; IIS 2020</footer>
		</body>
		</html>
	<?php
	}

	function redirect($dest)
	{
		$script = $_SERVER["PHP_SELF"];
		if (strpos($dest,'/')) {
			$path = $dest;
		} else {
			$path = substr($script, 0, strrpos($script, '/')) . "/$dest";
		}
		$name = $_SERVER["SERVER_NAME"] . ':' .$_SERVER["SERVER_PORT"];
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: http://$name$path");
	}

	function require_user()
	{
		if (!isset($_SESSION['user'])) {
			echo "<h1>Access forbidden</h1>";
			echo '<p><a href="index.php">Back to home page</a>';

			make_footer();
			exit();
		}
	}

	function require_admin()
	{
		if (trim($_SESSION['user']) == 'subik') {
			if (!isset($_SESSION['user'])) {
				echo "<h1>Access forbidden</h1>";
				echo '<p><a href="index.php">Back to home page</a>';

				make_footer();
				exit();
			}
		}
		echo '<p>'.$_SESSION['user'];
	}
	?>
