<?php 
	require "common.php";

	make_header();
 ?>
<link rel="stylesheet" href="view/css/style_checkout.css">
<body class="checkout-body">

<div class="container wrapper" >
            <div class="row cart-head" style="margin-top: 8%;">
                <div class="container">
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="cart.php" class="check-bc">Naspäť do košíka</a>  </span>
                    </div>
                </div>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>    
            <div class="row cart-body">
                <form class="form-horizontal" method="post" action="reservation_done.php">
                <div class="" >
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                        <div class="panel-heading">Údaje</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h4>Rezervácia lístkov</h4>
                                    <p> Údaje označené hviezdičkou sú povinné</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-xs-12">
                                    <strong>*Meno:</strong>
                                    <input required type="text" name="first_name" class="form-control" value=""/>
                                </div>
                                <div class="span1"></div>
                                <div class="col-md-6 col-xs-12">
                                    <strong>Priezvisko:</strong>
                                    <input type="text" name="last_name" class="form-control" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Adresa:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="address" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Mesto</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="city" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>PSČ:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="zip_code" class="form-control" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>Telefónne číslo:</strong></div>
                                <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value=""/></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong>*Email:</strong></div>
                                <div class="col-md-12"><input type="email" name="email_address" class="form-control" value="" required></div>
							</div>
						</div>
                        <form method="post">
                            <a href="reservation_done.php">
                                <input type="submit" name="test" id="test" value="Rezervovať lístky" class="btn btn-secondary btn-block"></input>
                            </a>
                        </form>
                </div>
                </form>
            </div>

    </div>
</body>

<?php
  
	make_footer();
 ?>
