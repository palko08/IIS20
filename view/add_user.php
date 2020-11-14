<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať nového užívateľa</h2>
        <form action="account_insert.php" method="post" class="form-container">
            <input type="text" placeholder="login" name="login" required>
            <input type="text" placeholder="meno" name="meno" required>
            <input type="password" placeholder="password" name="password" required>
            <input type="email" placeholder="email@email.com" name="email">
            <select class="custom-select">
                <option value="">Vybrať level oprávnenia</option>
                <option value="0">admin</option>
                <option value="1">poradatel</option>
                <option value="2">pokladní</option>
                <option value="3">divák</option>
            </select>
            <br>
            <button type="submit" class="btn btn-info" value="Register">Pridať</button>
            <button type="submit" class="btn btn-danger" onclick=closeForm("add_user")>Zatvoriť</button>
        </form>
    </div>
</div>