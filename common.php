<?php 
	session_start();

	function make_header()
	{
	?>
		<!DOCTYPE html>
        <html lang="sk-SK">
        <head>
			<meta charset="utf-8">
			<title>IIS Projekt 2020</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		</head>
		<body>
  		<header>
			<!-- Navigation bar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="index.php">DOMOV</a></li>
					<li><a href="festivals.php">FESTIVALY</a></li>
					<li><a href="#interpreti">INTERPRETI</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="signin.php">PRIHLÁSENIE</a></li>   <!-- TOTO SA BUDE MENIT PODLA TOHO CI JE PRIHLASENY --> 
					<li><a href="#cart">KOŠÍK</a></li>
				</ul>
			</div>
		</nav>
		</header>
	<?php
	}

	function make_footer()
	{
	?>
		<footer class="text-center">
           <p>Daša Nosková - xnosko05<br/>Matúš Paľko - xpalko08<br/>Patrik Šuba - xsubap00</p>
        </footer>
      </body>
      <style>
          .container-fluid{
             background-color: rgb(18, 17, 24);
             color: whitesmoke;  
          }
          /* Add a dark background color to the footer */
          footer {
			background-color: rgb(18, 17, 24);;
			color: rgba(245, 245, 245,0.5);
			padding: 32px;
          }
     </style>
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
