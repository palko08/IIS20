<?php
require "common.php";
require "services.php";
require "classVstupenka.php";
require "classFestival.php";
require_once "connect_db.php";

function make_Vstupenka($pdo,$vstupenka){
    $festival = new Festival();
    $festival->initExistingFestival($pdo,$vstupenka->getFestival_ID($pdo));
    echo '  <tr>
                <td>
                    <a class="no_color_change_link" id="ticket" href="festival_page.php?id='.$vstupenka->getFestival_ID($pdo).'">'.$vstupenka->getID().'</a>
                </td>
                <td>
                    <a class="no_color_change_link" id="stav">'.$vstupenka->getStav($pdo).'</a>
                </td>
                <td>
                    <a class="no_color_change_link" id="cena">'.$festival->getCena($pdo).'</a>
                </td>
            </tr>';
}

$vstupenka = new Vstupenka();
$serv = new AccountService();
$pdo = connect_db();

$person = $serv->getAccount($_SESSION['user']);
$vstupenkaArray = $vstupenka->getAllVstupenka($pdo,$person['registrovany_ID']);

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
                <th>Vstupenky</th>
                <th>Stav</th>
                <th>Cena</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($vstupenkaArray[0] != NULL) {
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

