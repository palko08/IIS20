<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať nového užívateľa</h2>
        <form name="add_user" action="account_insert.php" method="post" class="form-container" target="dummyframe">
            <input type="text" placeholder="login" name="login" id="add_user_login" required>
            <input type="text" placeholder="meno" name="meno" id="add_user_name" required>
            <input type="password" placeholder="password" name="password" id="add_user_psw" required>
            <input type="email" placeholder="email@email.com" name="email" id="add_user_email">
            <select class="custom-select">
                <option value="">Vybrať level oprávnenia</option>
                <option value="0">admin</option>
                <option value="1">poradatel</option>
                <option value="2">pokladní</option>
                <option value="3">divák</option>
            </select>
            <br>
            <button type="submit" class="btn btn-info" value="Register" onclick=clean_forms()>Pridať</button>
            <button type="submit" class="btn btn-danger" onclick=closeForm("add_user")>Zatvoriť</button>
        </form>
    </div>
</div>

<script>
    function clean_forms(){
        document.forms['add_user'].reset();
    }
</script>