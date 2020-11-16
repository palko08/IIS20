<?php
require "common.php";
require "classFestival.php";
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
			<input type="text" class="form-control form-rounded" placeholder="Nájsť festival"> 
			<div class="row text-center" style="background-color:rgb(31, 29, 30); padding-bottom:50px">
				<?php
					foreach ($festivalArray as $fest) {
						make_festival($fest,$pdo);
					}
				?>
			</div>
		</div>
	</div>
</body>
<?php
	make_footer();
?>
