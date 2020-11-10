<?php
require "common.php";
make_header();
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
                    <img src="../../img/lir.jpg" alt=""/>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="festival-head" >
                    <h2>Festival meno</h2>
                    <h5>Hodnotenie: </h5>
                    <h3>DD/MM/YYYY - DD/MM/YYYY</h3>
                    <h4>Adresa</h4>
                    <h6>štýl dnb</h6>
                    <div class="buy-ticket">
                    <div class="qty mt-5">
                        <span class="minus bg-dark">-</span>
                        <input type="number" class="count" name="qty" value="1">
                        <span class="plus bg-dark">+</span>
                        <button type="button" class="btn btn-info" id="reserve-tickets">Rezervovať lístky</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="festival-description">
        <p>POPIS
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris lorem velit, imperdiet in lectus et, interdum maximus ipsum. Duis consectetur in velit eget ornare. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec semper, nibh a consectetur tincidunt, felis felis lobortis sapien, vel efficitur sem purus et ligula. Sed dignissim ipsum at ipsum vestibulum pharetra. Nunc eleifend nunc ac nibh malesuada sollicitudin. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi maximus lacus odio, et rhoncus velit volutpat quis. Aenean scelerisque ante id venenatis pellentesque. Cras sed lacus ac neque rutrum sodales.
            Suspendisse cursus felis sed lectus fermentum venenatis nec vel lacus. Cras diam nulla, laoreet vel nunc nec, ullamcorper convallis purus. Nam id consequat felis. Vivamus ac pretium lacus. Quisque non aliquet diam. Vestibulum posuere suscipit ante, vel lobortis sem iaculis id. Nulla at nisl nibh. Mauris lorem ligula, iaculis vitae laoreet at, volutpat nec augue. In hac habitasse platea dictumst. Ut porttitor ante ac tellus volutpat ornare. Nulla porta vitae lectus at scelerisque. Donec condimentum ex a tellus ornare tincidunt. Cras malesuada cursus neque eget feugiat.
        </p>
        </div>
    </div>
</div>
</body>

<?php
make_footer();
?>
