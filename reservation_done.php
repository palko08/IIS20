<?php
require "common.php";

make_header();
?>
<?php
if (isset($_SESSION['user'])) {
   echo '<br><br><h1> vstupenky rezervované </h1>';
} else '<br><br><h1> vstupenky rezervované. 
        Zaregistrovať sa: 
        
        </h1>';?>

<?php

make_footer();
?>