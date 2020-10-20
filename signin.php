<?php 
	require "common.php";

	make_header();
 ?>

<style>
.login-form {
    width: 340px;
    margin: 200px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
</style>
<body>
<div class="login-form">
    <form action="/examples/actions/confirmation.php" method="post">
        <h2 class="text-center">Log in</h2>       
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
        </div>
        <div class="clearfix">
            <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
            <a href="#" class="float-right">Forgot Password?</a>
        </div>        
    </form>
    <p class="text-center"><a href="#">Create an Account</a></p>
</div>
</body>



<?php 
 if (isset($_SESSION['user'])) {
 	echo 'Current user: <strong>' . $_SESSION['user'] . '</strong>';
 	echo '<p><a href="admin.php">Go to admin page</a>';
 	echo '<p><a href="logout.php">Logout</a>';
 }
 else {
 	?>
 		<p><strong>Log In</strong> 
 		<div>
 			<form action="login.php" method="post">
 				<label for="login">Login</label>
 				<input type="text" name="login" id="login"><br>

 				<label for="password">Password</label>
 				<input type="password" name="password" id="password"><br>

 				<input type="submit" value="Log in">
 			</form>
 		</div>
         <p><a href="festivaly.php"><strong>Continue as quest</strong></a>
 <?php
}
	make_footer();
 ?>