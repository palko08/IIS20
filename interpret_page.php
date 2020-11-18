<?php
require "common.php";
require_once "controller_festival_interpret.php";
require_once "classInterpret.php";
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
                <h6><?php print_zanre($interpret,$pdo);?></h6>
                <h3>Členovia:</h3>
                <?php print_clenov($interpret,$pdo);
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
                get_vystupenia($pdo,$interpret);?>
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


