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
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php

    while($row = $query->fetch()) {
        $name = $serv->getName($row["login"]);
       ?>

    <form name="change_user" method="post" action="">
    <tr><td> <a name="id" class="no_color_change_link" id="user_id"><?php echo $row["registrovany_ID"]?></a></td>
        <td><input name="email" type="email" id="user_email" placeholder=<?php echo $row["email"]?>></td>
        <td><input name="name" type="text"id="user_name" placeholder=<?php echo $name?>></td>
        <td><input name="login" type="text" id="user_login" placeholder=<?php echo$row["login"]?>></td>
        <td> <input name="password" type="password" value="password" id="user_password" ></td>
        <td><div class="form-group">
                <select name="opravnenie" class="custom-select">
                    <option selected="0"><?php echo $row["level_opravnenia"]?></option>
                    <option value="1">poradatel</option>
                    <option value="2">pokladní</option>
                    <option value="3">divak</option>
                    <option value="4">admin</option>
                </select>
        </td>
        <td><button type="button" id="align-right" name="delete_btn" class="btn btn-danger" onclick="location.href='delete.php?type=USER&id=<?php echo $row["registrovany_ID"]?>'"> Odstrániť </button></td>
        <td><button type="submit" id="align-right" name="update" class="btn btn-info"> Potvrdiť zmeny </button></td>
    </tr>
    </form>
    <?php
    }
    ?>
    </tbody>
</table>
