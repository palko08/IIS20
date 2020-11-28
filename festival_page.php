<?php
require "common.php";
require_once "controller.php";
require_once "classFestival.php";
require "connect_db.php";

$pdo = connect_db();
$festival = new Festival();
$festival->initExistingFestival($pdo, $_GET['id']);

make_header();

?>
<meta http-equiv="refresh" content="600;url=logout.php" />
<link rel="stylesheet" href="view/css/festival_interpret_page.css">
<body class="festival-body">
<div class="container festival-main">
        <div class="row">
            <div class="col-sm-4">
                <div class="festival-img">
                    <img src="<?php echo $festival->getObrazok($pdo);?>" alt="Obrastok"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="festival-head" >
                    <h2><?php echo $festival->getNazov($pdo);?></h2>
                    <h6><?php print_zanre($festival, $pdo, "line");?></h6>
                    <h5>Kapacita:<?php echo $festival->getKapacita($pdo);?></h5>
                    <h3><?php echo $festival->getDatum_Od($pdo);?> - <?php echo $festival->getDatum_Do($pdo);?></h3>
                    <h4>Adresa: <?php echo $festival->getAdresa($pdo);?></h4>
                    <h6><?php print_zanre($festival, $pdo, "line");?></h6>
                    <h3>Cena: <?php echo $festival->getCena($pdo);?></h3>
                </div>
            </div>
        </div>
    <div class="row">
         <div class="festival-ticket-input">
            <form method="post" action="add_ticket_rezervation.php?festival_id=<?php echo $festival->getID()?><?php if($_SESSION['user'] != NULL) echo '&login='.$_SESSION["user"]?>">
                <input type="number" class="count" name="pocet" value="0" min="0">
                <button type="submit" class="btn btn-info" id="reserve-tickets">Rezervovať lístky</button>
            </form>
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="festival-description">
        <p>POPIS<br>
            <?php echo $festival->getPopis($pdo);?>
        </p>
        </div>
    </div>
</div>
</body>

<?php
make_footer();
?>
