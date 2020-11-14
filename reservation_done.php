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

make_footer();
?>