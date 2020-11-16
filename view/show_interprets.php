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
    <form name="change_interpret" method="post" action="">
    <tr>
        <td>
            <a class="no_color_change_link" id="interpret_id"><?php echo $interpret->getID();?></a>
        </td>
        <td>
            <input type="text" placeholder=<?php echo $interpret->getNazov($pdo);?> id="meno">
        </td>
        <td>
            <input type="text" placeholder=<?php echo $interpret->getHodnotenie($pdo);?> id="interpret_rating">
        </td>
        <td>
            <input type="file" name="artist_foto" value="<?php echo $interpret->getLogo($pdo);?>"/>
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