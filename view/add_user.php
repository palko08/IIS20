<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

<div class="jumbotron">
    <div class="span8 centering">
        <h2>Pridať nového užívateľa</h2>
        <form name="add_user" action="account_insert.php?type=admin" method="post" class="form-container" target="dummyframe">
            <input type="text" placeholder="login" name="login" id="add_user_login" required>
            <input type="text" placeholder="meno" name="meno" id="add_user_name" required>
            <input type="password" placeholder="password" name="password" id="add_user_psw" required>
            <input type="email" placeholder="email@email.com" name="email" id="add_user_email">
            <select name="opravnenie" class="custom-select">
                <option value="admin">admin</option>
                <option value="poradatel">poradatel</option>
                <option value="pokladni">pokladní</option>
                <option value="divak">divák</option>
            </select>
            <br>
            <button type="submit" class="btn btn-info" value="Register" onClick="window.location.reload();">Pridať</button>
            <button type="submit" class="btn btn-danger" onclick=closeForm("add_user")>Zatvoriť</button>
        </form>
    </div>
</div>
