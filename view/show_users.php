<?php
require "services.php";
$serv = new AccountService();
$query = $serv->getAccounts();
?>
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
    <?php
    while($row = $query->fetch()) {
        $name = $serv->getName($row["login"]);
    print "
    <tr><td> <a class=\"no_color_change_link\" id=\"user_id\">".$row["registrovany_ID"]."</a></td>
        <td><input type=\"email\" id=\"user_email\" value=".$row["email"]."></td>
        <td><input type=\"text\"id=\"user_name\" value=".$name."></td>
        <td><input type=\"text\" id=\"user_login\" value=".$row["login"]."></td>
        <td> <input type=\"password\" value=\"password\" id=\"user_password\" ></td>
        <td><div class=\"form-group\">
                <select class=\"custom-select\">
                    <option selected=\"0\">".$row["level_opravnenia"]."</option>
                    <option value=\"1\">poradatel</option>
                    <option value=\"2\">pokladní</option>
                    <option value=\"3\">divák</option>
                    <option value=\"4\">admin</option>
                </select>
        </td>
        <td><input type=\"file\" name=\"users_foto\"/></td>
        <td><button type=\"button\" id=\"align-right\"> vymazať </button></td>
        <td><button type=\"button\" id=\"align-right\"> potvrdiť zmeny </button></td>
    </tr>";
        }
    ?>
    </tbody>
</table>
