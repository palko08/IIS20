<?php 
	require "common.php";

	make_header();
 ?>

<main class="main">
<!-- Carousel -->
<div id="theCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#theCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#theCarousel" data-slide-to="1"></li>
        <li data-target="#theCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Define the text to place over the image -->
    <div class="carousel-inner">
        <div class="item active" >
             <div class ="slide1"></div>
        </div>
        <div class="item">
             <div class="slide2"></div>
        </div>
        <div class="item">
             <div class="slide3"></div>
        </div>
  </div>

    <!-- SLIDER -->   
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#theCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="right carousel-control" href="#theCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      </a>
</div>
</main>

 
<?php
make_footer();
?>
