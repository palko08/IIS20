<?php
require "common.php";
require_admin();
make_head();
?>
    <script type="text/javascript" src="view/show_elements.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="view/css/admin_page.css">
<body>
<?php
require("view/admin_body.php");
?>

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

<div class="form-popup" id="add_user">
    <?php
    require("view/add_user.php");
    ?>
</div>

<div class="container" id="container">
    <div class="col-sm" id="tickets">
        <?php
        require("view/show_tickets.php");
        ?>
    </div>
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
    <div class="col-sm" id="users">
            <?php
            require("view/show_users.php");
            ?>
    </div>
</div>

</body>

<?php
make_footer();
?>




