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
$vstupenkaArray = get_user_vstupenky($pdo,$person['registrovany_ID']);

make_header();
?>
<meta http-equiv="refresh" content="600;url=logout.php" />
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
                    $pay = 0;
                    if ($vstupenkaArray != NULL) {
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