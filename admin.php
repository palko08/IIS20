<?php
require "common.php";
require_once "services.php";

$serv = new AccountService();
$person = $serv->getAccount($_SESSION['user']);
make_head();
if ($person['level_opravnenia'] == 'divak' || !isset($_SESSION['user'])) {
    echo "<h1>NEDOVOLENY PRISTUP</h1>";

}
else {
?>
    <meta http-equiv="refresh" content="600;url=logout.php" />
    <script type="text/javascript" src="view/show_elements.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="view/css/admin_page.css">
<body>
<?php
if ($person['level_opravnenia'] == 'poradatel' || $person['level_opravnenia'] == 'admin' ) {
require("view/admin_body.php");
?>
<div class="form-popup" id="add_tickets_admin">
    <?php
    require("view/add_ticket_admin.php");
    ?>
</div>
<div class="form-popup" id="add_festivals">
    <?php
    require("view/add_festival.php");
    ?>
</div>

<div class="form-popup" id="add_interprets">
    <?php
    require("view/add_artist.php");
    ?>
</div>
<?php
    if (isset($_GET['error'])){
        echo '<p style="color:#FF0000">Datum od musi byt mensi ako datum do.</p>';
    }
if ($person['level_opravnenia'] == 'admin') {
?>
<div class="form-popup" id="add_user">
    <?php
    require("view/add_user.php");
    ?>
</div>
    <div class="form-popup" id="add_interpret_festival">
        <?php
        require_once ("view/add_interpret_to_festival.php");
        ?>
    </div>
    <?php
}
?>
<div class="form-popup" id="add_interpret_member">
    <?php
    require_once("view/add_members.php");
    ?>
</div>
    <?php
}
?>
<div class="container" id="container">
    <div class="col-sm" id="tickets">
        <?php
        require("view/show_tickets.php");
        ?>
    </div>
    <?php
    if ($person['level_opravnenia'] == 'poradatel' || $person['level_opravnenia'] == 'admin' ) {
    ?>
    <div class="col-sm" id="festivals">
            <?php
            require("view/show_festivals.php");
            ?>
    </div>
    <div class="col-sm" id="interprets">
            <?php
            require("view/show_interprets.php");
            ?>
    </div>
    <?php
    if ($person['level_opravnenia'] == 'admin') {
    ?>
    <div class="col-sm" id="users">
            <?php
            require("view/show_users.php");
            ?>
    </div>
    <?php
    }
    }
    ?>
</div>

</body>

<?php
make_footer();
}
?>




