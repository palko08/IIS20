<?php
require "common.php";
require_once "classInterpret.php";
require_once "classZaner.php";
require_once "classFestival.php";
require_once "classClen.php";
require_once "classPodium.php";
require "connect_db.php";

$pdo = connect_db();
$interpret = new Interpret();
$interpret->initExistingInterpret($pdo, $_GET['id']);

make_header();
?>

<link rel="stylesheet" href="view/css/festival_interpret_page.css">
<body class="interpret-body">
<div class="container interpret-main">
    <div class="row">
        <div class="col-sm-4">
            <div class="interpret-img">
                <img src="<?php echo $interpret->getLogo($pdo);?>" alt="Obrastok"/>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="interpret-head" >
                <h2><?php echo $interpret->getNazov($pdo);?></h2>
                <h6><?php $zanre = $interpret->getZanre($pdo);
                    foreach ($zanre as $row) {
                        $zaner = new Zaner();
                        if ($zaner->initExistingZaner($pdo,$row[0]) == -1) {
                            echo "nenasli sme v datbazke dany row<br>";
                        }
                        echo $zaner->getZaner_nazov($pdo);
                        }
                ?></h6>
                <h3>Členovia:</h3>
                <?php $clenovia = $interpret->getClenov($pdo);
                    foreach ($clenovia as $row){
                        $clen = new Clen();
                        if ($clen->initExistingClen($pdo,$row[0]) == -1) {
                            echo "nenasli sme v datbazke dany row<br>";
                        }
                        echo "<h4>".$clen->getClovekMeno($pdo)."</h4>";
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="interpret-festivals">
            <table>
                <thead>
                <th>Dátum</th>
                <th>Festival</th>
                <th>Pódium</th>
                <th>Čas</th>
                </thead>
                <tbody>
                <?php
                $vystupenia = $interpret->getVystupenia($pdo);
                foreach ($vystupenia as $row){
                    $podium = new Podium();
                    if ($podium->initExistingPodium($pdo,$row[0]) == -1) {
                        echo "nenasli sme v datbazke dany row<br>";
                    }
                    $festival = new Festival();
                    $festival_id = $podium->getFestival_ID($pdo);
                    if ($podium->initExistingPodium($pdo,$festival_id) == -1) {
                        echo "nenasli sme v datbazke dany row<br>";
                    }

                    $datum = date_parse_from_format ( 'Y-m-d H:i:s' , $podium->getCas_vystupenia($pdo,$interpret->getID()));
                    echo "<tr><td>".$datum['day'].".".$datum['month'].".".$datum['year']."</td>";
                    echo "<td>".$festival->getNazov($pdo)."</td>";
                    echo "<td>".$podium->getNazov($pdo)."</td>";
                    echo "<td>".$datum['hour'].".".$datum['minute']."</td></tr>";

                }?>
                </tbody>
                </table>
            </p>
        </div>
    </div>
</div>
</body>

<?php
make_footer();
?>


