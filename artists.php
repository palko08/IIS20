<?php
require "common.php";
require_once "classInterpret.php";
require_once "connect_db.php";
require_once "controller_festival_interpret.php";

$pdo = connect_db();
$interpret = new Interpret();
$interpretArray = $interpret->getAllInterpret($pdo);
make_header();
?>

<body>
     <div class="bg-1">
		<div class="container">
			<h3 class="text-center" style="margin-top:150px; color:white; position:relative">INTERPRETI</h3>
            <form action="artists.php" method="GET">
			<input type="text" name="search" class="form-control form-rounded" placeholder="Nájsť interpreta">
            <center><input id="submit" type="submit" value="Search" class="btn btn-secondary"></center>
            </form>
            <br>
            <div class="row" style="margin-bottom: 25px;">
            <br>
                <?php
                make_interprets_festivals($interpretArray,$pdo);
                ?>
            </div>
        </div>
    </div>
</body>


<?php
	make_footer();
?>

<style> 
img{
    width:250px;
    height:250px;
}
.thumbnail{
    max-width:100%;
max-height:100%;
    position: center;
}
</style>
