<?php
require "common.php";
require "classVstupenka.php";
require "services.php";
require "controller.php";
require_once "connect_db.php";

$vstupenka = new Vstupenka();
$serv = new AccountService();
$pdo = connect_db();
$person = $serv->getAccount($_SESSION['user']);
$vstupenkaArray = $vstupenka->getAllVstupenka($pdo,$person['registrovany_ID']);

function make_product($pdo, $vstupenka){
    echo '<tr>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading"><a href="festival_page.php?id='.$vstupenka->getFestival_ID($pdo).'">Vstupenka</a></h4>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            <div class="number-input md-number-input">
                                <input class="quantity" min="0" name="quantity" value="1" type="number">
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>'.get_cena($vstupenka,$pdo).'</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>'.get_cena($vstupenka,$pdo).'</strong></td>
                        <td class="col-sm-1 col-md-1">
                        <button type="button" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Odstrániť
                        </button></td>
                    </tr>';
}

make_header();
?>
<body class="cart">

<div class="cart-wrap">
<div class="container">
    <div style="margin-top:150px; margin-bottom:100px" class="row" >
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <thead>
                    <tr><th><h1>Košík</h1></th></tr>
                    <tr>
                        <th>Vstupenky</th>
                        <th>Počet</th>
                        <th class="text-center">Cena</th>
                        <th class="text-center">Celkom</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($vstupenkaArray[0] != NULL) {
                        foreach ($vstupenkaArray as $vstup) {
                            make_product($pdo, $vstup);
                            $pay = $pay + get_cena($vstup,$pdo);
                        }
                    }
                    ?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Spolu</h3></td>
                        <td class="text-right"><h3><strong><?php echo $pay;?></strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <button type="button" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            <a href="festivals.php">Continue Shopping</a>
                        </button></td>
                        <td>
                        <button type="button" class="btn btn-success">
                            <a href="checkout.php">Rezervovať</a>
                             <span class="glyphicon glyphicon-play"></span>
                        </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>
<?php
	make_footer();
?>