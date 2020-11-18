<?php
require_once "classZaner.php";
require_once "classFestival.php";
require_once "classPodium.php";
require_once "classClen.php";

function print_zanre($obj,$pdo)
{
    $zanre = $obj->getZanre($pdo);
    foreach ($zanre as $row) {
        $zaner = new Zaner();
        if ($zaner->initExistingZaner($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        echo $zaner->getZaner_nazov($pdo) . " ";
    }
}

function get_vystupenia($pdo,$obj){

    $vystupenia = $obj->getVystupenia($pdo);
    foreach ($vystupenia as $row) {
        $podium = new Podium();
        if ($podium->initExistingPodium($pdo, $row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }

        $festival = new Festival();
        $id = $podium->getFestival_ID($pdo);

        if ($podium->initExistingPodium($pdo, $id) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }

        $datum = date_parse_from_format('Y-m-d H:i:s', $podium->getCas_vystupenia($pdo, $obj->getID()));
        echo "<tr><td>" . $datum['day'] . "." . $datum['month'] . "." . $datum['year'] . "</td>";
        echo "<td>" . $festival->getNazov($pdo) . "</td>";
        echo "<td>" . $podium->getNazov($pdo) . "</td>";
        echo "<td>" . $datum['hour'] . "." . $datum['minute']."0". "</td></tr>";

    }
}

function print_clenov($obj,$pdo){
    $clenovia = $obj->getClenov($pdo);
    foreach ($clenovia as $row){
        $clen = new Clen();
        if ($clen->initExistingClen($pdo,$row[0]) == -1) {
            echo "nenasli sme v datbazke dany row<br>";
        }
        echo "<h4>".$clen->getClovekMeno($pdo)."</h4>";
    }
}

function make_interprets_festivals($array, $pdo){

    if ($array[0] != NULL) {
        foreach ($array as $obj) {
            if ($_GET['search'] != NULL) {
                if (strstr($obj->getNazov($pdo), $_GET['search']) != FALSE) {
                    if (get_class($obj) == Interpret::class)
                        make_Interpret($obj, $pdo);
                    else if (get_class($obj) == Festival::class)
                        make_festival($obj,$pdo);
                }
            }
            else{
                if (get_class($obj) == Interpret::class)
                    make_Interpret($obj, $pdo);
                else if (get_class($obj) == Festival::class)
                    make_festival($obj,$pdo);
            }
        }
    }
}
function make_Interpret($interpret, $pdo){
    echo '<div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                    <a href="interpret_page.php?id='.$interpret->getID().'">
                    <div class="thumbnail">
					<img src="'.$interpret->getLogo($pdo).'" alt="'.$interpret->getNazov($pdo).'">
					<div class="text-center" style="margin-top:5px"><strong>'.$interpret->getNazov($pdo).'</strong></div>
					</div>
                </div>';
}

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
?>