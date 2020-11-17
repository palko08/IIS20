<?php
require "common.php";
require "classFestival.php";
require "connect_db.php";

make_header();
?>

<body>
     <div class="bg-1">
		<div class="container">
			<h3 class="text-center" style="margin-top:150px; color:white; position:relative">INTERPRETI</h3>
			<input type="text" class="form-control form-rounded" placeholder="Nájsť interpreta"> 
            <div class="row" style="margin-bottom: 25px;">
            <br>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6">
                    <div class="thumbnail">
					<img src="img/dimension.jpg" alt="Dimension">
					<div class="text-center" style="margin-top:5px"><strong>Dimension</strong></div>
					</div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6" >
                    <div class="thumbnail">
					<img src="img/subfocus.jpg" alt="SubFocus">
					<div class="text-center" style="margin-top:5px"><strong>Sub Focus</strong></div>
					</div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6" >
                    <div class="thumbnail">
					<img src="img/Delta_Heavy.jpg" alt="Deltaheavy">
					<div class="text-center" style="margin-top:5px"><strong>Delta Heavy</strong></div>
					</div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-6" >
                    <div class="thumbnail">
					<img src="img/hybridminds.jpg" alt="Hybridminds">
					<div class="text-center" style="margin-top:5px"><strong>Hybrid Minds</strong></div>
					</div>
                </div>
            </div>
        </div>
    </div>
</body>


<?php
	make_footer();
?>

<style> 
img{
    width:250px;
    height:250px;
}
.thumbnail{
    max-width:100%;
max-height:100%;
    position: center;
}
</style>
