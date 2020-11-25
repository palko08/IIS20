<?php
require "common.php";
require_once  "services.php";
require_once  "classVstupenka.php";
require_once  "classFestival.php";
require_once "controller.php";
require_once "connect_db.php";


$vstupenka = new Vstupenka();
$serv = new AccountService();
$pdo = connect_db();
$person = $serv->getAccount($_SESSION['user']);

$vstupenkaArray = get_user_vstupenky_all($pdo,$person['registrovany_ID']);

make_header();
?>

<link rel="stylesheet" href="view/css/tickets.css">

<body class="tickets_body">
<div class="" id="header">
    <h1>Vstupenky</h1>
</div>
<div class="container" id="container">
    <div class="col-sm" id="tickets_cols">
        <table class="table">
            <thead>
                <tr>
                <th>Vstupenka</th>
                <th>Stav</th>
                <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($vstupenkaArray != NULL) {
                        foreach ($vstupenkaArray as $vstup) {
                            make_Vstupenka($pdo, $vstup);
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>

<?php
make_footer();
?>

