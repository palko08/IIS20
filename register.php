<?php
	require "common.php";
	make_header();
?>
    <link rel="stylesheet" href="css/register.css">
<br><br>
<div class="register">
<div class="col-lg-4 col-md-4 col-md-offset-4" id="login">
    <h1>Vytvoriť nový účet</h1>
    <section id="inner-wrapper" class="login">
        <article>
    <form action="account_insert.php" method="post">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                <input type="email" class="form-control" placeholder="Email" name="email" id="email" required><br>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"> </i></span>
                <input type="text" name="meno" id="meno"  class="form-control" placeholder="Meno" required><br>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"> </i></span>
                <input type="text" name="login" id="login" class="form-control" placeholder="Login" required><br>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"> </i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required><br>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-block" value="Register">Registrovať</button>
        <br>
    </form>
        </article>
    </section></div>
</div>
<?php
make_footer();
?>