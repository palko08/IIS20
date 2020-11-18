<?php
require "common.php";
require_once "classFestival.php";
require "connect_db.php";

function make_festival($festival,$pdo)
{
	echo '<div class="col-sm-4">
        <a href="festival_page.php?id='.$festival->getID().'">
		<div class="thumbnail">
		<img src="'. $festival->getObrazok($pdo) .'" alt="Obrastok">
		<p style="margin-top:5px"><strong>'.$festival->getNazov($pdo).'</strong></p>
		<p>od :'.$festival->getDatum_Od($pdo).'</p>
		<p>do :'.$festival->getDatum_Do($pdo).'</p>
		<button class="btn">Buy Tickets</button>
		</div>
        </a>
	</div>';
}

$pdo = connect_db();

$idSelect = $pdo->prepare("SELECT festival_ID FROM Festival");
$idSelect->execute();
$results = $idSelect->fetchAll();
$festivalArray;
foreach ($results as $row) {
	$festival = new Festival();
	if ($festival->initExistingFestival($pdo,$row[0]) == -1) {
		echo "nenasli sme v datbazke dany row<br>";
	}
	$festivalArray[] = $festival;
}

make_header();
?>
<body>
     <div class="bg-1">
		<div class="container">
			<h3 class="text-center" style="margin-top:150px; color:white; position:relative">FESTIVALY</h3>
			<form action="festivals.php" method="GET">
			<input id="search" name="search" type="text" class="form-control form-rounded" placeholder="Nájsť festival"> 
			<center><input id="submit" type="submit" value="Search" class="btn btn-secondary"></center>
			</form>
			<div class="row text-center" style="background-color:rgb(31, 29, 30); padding-bottom:50px">
				<?php
                    if ($festivalArray[0] != NULL) {
                        foreach ($festivalArray as $fest) {
                            if ($_GET['search'] != NULL) {
                                if (strstr($fest->getNazov($pdo), $_GET['search']) != FALSE) {
                                    make_festival($fest, $pdo);
                                }
                            } else {
                                make_festival($fest, $pdo);
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
