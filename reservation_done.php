<?php
require "common.php";

make_header();
?>
<div class="jumbotron" >
   <br><h1 style="text-align: center"> Vstupenky rezervované </h1>
</div>
<?php
if (isset($_SESSION['user'])) {
   echo '<br><a href="tickets.php">Zarezervované vstupenky</a>';
} else{
    include ("view/register.html"); } ?>

<?php
    require "classVstupenka.php";
    require "services.php";
    require "controller.php";
    require_once "connect_db.php";
    
    $pdo = connect_db();
    $serv = new AccountService();
    $vstupenkaArray;
    if($_SESSION['user'] != NULL){
        $person = $serv->getAccount($_SESSION['user']);
        $vstupenkaArray = get_user_vstupenky($pdo, $person['registrovany_ID']);
    }
    else if ($_SESSION['id'] != NULL){
        $vstupenkaArray = get_nouser_vstupenky($pdo, $_SESSION['id']);
    }
    if($vstupenkaArray != NULL){
        foreach ($vstupenkaArray as $vstupenka) {
            if($vstupenka->setStav($pdo, 'rezervovana') == 1){
                throw new Exception("Nedokazalo updatnut stav vstupenky!");
            }
        }
    }
?>

<?php

make_footer();
?>