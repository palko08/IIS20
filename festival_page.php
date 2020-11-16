<?php
require "common.php";
require "classFestival.php";
require "connect_db.php";

$pdo = connect_db();
$festival = new Festival();
$festival->initExistingFestival($pdo, $_GET['id']);

make_header();
//TODO rozpis na podiach pridat
?>
<script>
    $(document).ready(function(){
        $('.count').prop('disabled', true);
        $(document).on('click','.plus',function(){
            $('.count').val(parseInt($('.count').val()) + 1 );
        });
        $(document).on('click','.minus',function(){
            $('.count').val(parseInt($('.count').val()) - 1 );
            if ($('.count').val() == 0) {
                $('.count').val(1);
            }
        });
    });
</script>

<link rel="stylesheet" href="view/css/festival_page.css">
<body class="festival-body">
<div class="container festival-main">
        <div class="row">
            <div class="col-sm-4">
                <div class="festival-img">
                    <img src="<?php echo $festival->getObrazok($pdo);?>" alt="Obrastok"/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="festival-head" >
                    <h2><?php echo $festival->getNazov($pdo);?></h2>
                    <h5>Kapacita:<?php echo $festival->getKapacita($pdo);?></h5>
                    <h3><?php echo $festival->getDatum_Od($pdo);?> - <?php echo $festival->getDatum_Do($pdo);?></h3>
                    <h4><?php echo $festival->getAdresa($pdo);?></h4>
                    <h6><?php echo $festival->getZanre($pdo);?></h6>
                </div>
            </div>
        </div>
    <div class="row">

        <div class="qty mt-5 col-sm-6">
            <span class="minus bg-dark">-</span>
            <input type="number" class="count" name="qty" value="1">
            <span class="plus bg-dark">+</span>
            <button type="button" class="btn btn-info" id="reserve-tickets">Rezervovať lístky</button>
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="festival-description">
        <p>POPIS<br>
            <?php echo $festival->getPopis($pdo);?>
        </p>
        </div>
    </div>
</div>
</body>

<?php
make_footer();
?>
