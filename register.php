<?php
	require "common.php";
	make_header();
?>
<br><br>
<h1>Vytvorit novy ucet</h1>

<form action="account_insert.php" method="post">
	<label for="email">E-mail</label>
    <input type="text" name="email" id="email"><br>

    <label for="meno">Meno</label>
    <input type="text" name="meno" id="meno"><br>

    <label for="login">Login</label>
    <input type="text" name="login" id="login"><br>
    
    <label for="password">Password</label>
    <input type="password" name="password" id="password"><br>
    
    <input type="submit" value="Register">
</form>

<?php
make_footer();
?>