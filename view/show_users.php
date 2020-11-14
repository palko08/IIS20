<table class="table">
    <thead>
    <h1>Užívatelia</h1>
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Meno</th>
        <th>Login</th>
        <th>Heslo</th>
        <th>Oprávnenie</th>
        <th>Fotka</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <!-- TOTO SA HODI DO CLASS FUNKCIE -->
    <tr>
        <td>
            <a class="no_color_change_link" id="user_id">ID</a>
        </td>
        <td>
            <input type="email" placeholder="email" id="user_email">
        </td>
        <td>
            <input type="text" placeholder="Meno" id="user_name">
        </td>
        <td>
            <input type="text" placeholder="login" id="user_login">
        </td>
        <td> <input type="password" placeholder="password" id="user_password" ></td>
        <td>
            <div class="form-group">
                <select class="custom-select">
                    <option value="">Vybrať level oprávnenia</option>
                    <option value="0">admin</option>
                    <option value="1">poradatel</option>
                    <option value="2">pokladní</option>
                    <option value="3">divák</option>
                </select>
        </td>
        <td>
            <input type="file" name="users_foto"/>
        </td>
        <td>
            <button type="button" id="align-right"> vymazať </button>
        </td>
        <td><button type="button" id="align-right"> potvrdiť zmeny </button></td>
    </tr>
    </tbody>
</table>