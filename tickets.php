<?php
require "common.php";
require "services.php";

make_header();
?>

<link rel="stylesheet" href="css/tickets.css">

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
            <!-- TOTO SA HODI DO FUNKCIE -->
            <tr>
                <td>
                    <a class="no_color_change_link" id="ticket" href="#festival">vstupenka</a>
                </td>
                <td>
                    <a class="no_color_change_link" id="stav">stav</a>
                </td>
                <td>
                    <a class="no_color_change_link" id="cena">cena</a>
                </td>
            </tr>
            <!-- TOTO SA HODI DO FUNKCIE -->

            </tbody>
        </table>
    </div>
</div>
</body>

<?php
make_footer();
?>

