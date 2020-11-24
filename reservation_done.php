<?php
require "common.php";
require "classVstupenka.php";
require "services.php";
require "controller.php";
require_once "connect_db.php";

$pdo = connect_db();
$serv = new AccountService();
$person = $serv->getAccount($_SESSION['user']);
$vstupenkaArray = get_user_vstupenky($pdo,$person['registrovany_ID']);

foreach ($vstupenkaArray as $vstupenka) {
	if($vstupenka->setStav($pdo, 'rezervovana') == 1){
        throw new Exception("Nedokazalo updatnut stav vstupenky!");
    }
}

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

make_footer();

?>

