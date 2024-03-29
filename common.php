<?php 
    //TO DO HEADER prekryva ine prvky ked sa okno zmensi 
	session_start();

	function make_head(){
    ?>
        <!DOCTYPE html>
        <html lang="sk-SK">
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8">
			<title>IIS Projekt 2020</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<link rel="stylesheet" href="view/css/styling.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		</head>
        <?php
    }

	function make_header()
	{
        make_head();
	?>
		<body>
		<div id="page-container">
          <div id="content-wrap">
  		<header>
			<!-- Navigation bar -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="index.php">DOMOV</a></li>
					<li><a href="festivals.php">FESTIVALY</a></li>
					<li><a href="artists.php">INTERPRETI</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li> <?php
						  if (isset($_SESSION['user'])) {
							echo '<a href="profile.php">ÚČET</a></li>';
						} else echo '<a href="signin.php">PRIHLÁSIŤ SA</a></li>';?> 
					<li><a href="cart.php">KOŠÍK</a></li>
				</ul>
			</div>
		</nav>
		</header>
	<?php
	}

	function make_footer()
	{
	?>
	    </div>
		<footer class="text-center">
           <p>Daša Nosková - xnosko05<br/>Matúš Paľko - xpalko08<br/>Patrik Šuba - xsubap00</p>
		</footer>
		</div>
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
	//To Do nefunguje ako ma
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
		//echo '<p>'.$_SESSION['user'];
	}
	?>
