<?php
require "classInterpret.php";
require_once "connect_db.php";
$pdo = connect_db();
$idSelect = $pdo->prepare("SELECT interpret_ID FROM Interpret");
$idSelect->execute();

$results = $idSelect->fetchAll();

$interprets = array();

foreach($results as $row) {
    $interpret = new Interpret();
    if($interpret->initExistingInterpret($pdo, $row[0]) == -1){
        echo "nenasli sme v databazke dany row<br>";
    }
    $interprets[] = $interpret;
}
?>

<table class="table">
    <thead>
    <h1>Interpreti</h1>
    <tr>
        <th>ID</th>
        <th>Meno</th>
        <th>Hodnotenie</th>
        <th>Fotka</th>
        <th> Pridať na festival </th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($interprets as $interpret){
    ?>
    <form name="change_festival" method="post" action="">
    <tr>
        <td>
            <a class="no_color_change_link" id="interpret_id">ID</a>
        </td>
        <td>
            <input type="text" placeholder="meno" id="interpret_name">
        </td>
        <td>
            <input type="text" placeholder="hodnotenie" id="interpret_rating">
        </td>
        <td>
            <input type="file" name="artist_foto"/>
        </td>
        <td>
            <div class="form-group">
                <select class="custom-select" multiple>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                </select>
        </td>
        <td>
            <button type="button" id="align-right"> vymazať </button>
            <button type="button" id="align-right"> potvrdiť zmeny </button>
        </td>
    </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</table>