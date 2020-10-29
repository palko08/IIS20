<?php 
	require "common.php";

	make_header();
 ?>
 <?php 
 if (isset($_SESSION['user'])) {
 	echo 'Current user: <strong>' . $_SESSION['user'] . '</strong>';
 	echo '<p><a href="admin.php">Go to admin page</a>';
 	echo '<p><a href="logout.php">Logout</a>';
 }
 else {
 	?>
<body class="signin">
<div class="login-form">
    <form action="login.php" method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" required="required" 
                   name="username" id="username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required"
                   name="password" id="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div>        
    </form>
    <p class="text-center"><a href="register.php">Zaregistrovat sa</a></p>
    <p class="text-center"><a href="festivals.php">Pokračovať bez prihlásenia</a></p>
</div>
</body>

 <?php
  }
	make_footer();
 ?>
