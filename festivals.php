<?php
require "common.php";

make_header();
?>

<body id="festivals">
     <div class="bg-1">
		<div class="container">
			<h3 class="text-center" style="margin-top:150px; color:white; position:relative">FESTIVALY</h3>
			<input type="text" class="form-control form-rounded" placeholder="Nájsť festival"> 
			<div class="row text-center" style="background-color:rgb(31, 29, 30)">
				<div class="col-sm-4">
					<div class="thumbnail">
					<img src="img/lir3.jpg" alt="Paris">
					<p style="margin-top:5px"><strong>Paris</strong></p>
					<p>1-3 August 2020</p>
					<button class="btn">Buy Tickets</button>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
					<img src="img/lir2.jpg" alt="New York">
					<p style="margin-top:5px"><strong>New York</strong></p>
					<p>Sat. 28 November 2015</p>
					<button class="btn">Buy Tickets</button>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="thumbnail">
					<img src="img/lir.jpg" alt="San Francisco">
					<p style="margin-top:5px"><strong>San Francisco</strong></p>
					<p>Sun. 29 November 2015</p>
					<button class="btn">Buy Tickets</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<?php
	make_footer();
?>