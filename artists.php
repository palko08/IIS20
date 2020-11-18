<?php
require "common.php";
require_once "classInterpret.php";
require_once "connect_db.php";

function make_Interpret($interpret, $pdo){
    echo '<div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                    <div class="thumbnail">
					<img src="'.$interpret->getLogo($pdo).'" alt="'.$interpret->getNazov($pdo).'">
					<div class="text-center" style="margin-top:5px"><strong>'.$interpret->getNazov($pdo).'</strong></div>
					</div>
                </div>';
}

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
            <div class="row" style="margin-bottom: 25px;">
            <br>
                <?php
                if ($interpretArray[0] != NULL) {
                    foreach ($interpretArray as $inter) {
                        if ($_GET['search'] != NULL) {
                            if (strstr($inter->getNazov($pdo), $_GET['search']) != FALSE) {
                                make_Interpret($inter, $pdo);
                            }
                        }
                        else{
                            make_Interpret($inter, $pdo);
                        }
                    }
                }
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
