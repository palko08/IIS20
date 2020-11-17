<?php
require_once "classFestival.php";
require_once "connect_db.php";

function get_festivals($pdo)
{
    $idSelect = $pdo->prepare("SELECT festival_ID FROM Festival");
    $idSelect->execute();

    $results = $idSelect->fetchAll();

    $festivals = array();

    foreach ($results as $row) {
        $festival = new Festival();
        if ($festival->initExistingFestival($pdo, $row[0]) == -1) {
            echo "nenasli sme v databazke dany row<br>";
        }
        $festivals[] = $festival;
    }

    return $festivals;
}