<?php
require_once "services.php";
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

    <form name="change_user" method="post" action='update_users.php?type=admin&login=<?php echo $row["login"]?>&id=<?php echo $row["registrovany_ID"]?>'>
    <tr><td> <a name="id" class="no_color_change_link" id="user_id"><?php echo $row["registrovany_ID"]?></a></td>
        <td><input name="email" type="email" id="user_email" placeholder="<?php echo $row["email"]?>"></td>
        <td><input name="name" type="text"id="user_name" placeholder="<?php echo $name?>"></td>
        <td><input name="login" type="text" id="user_login" placeholder="<?php echo$row["login"]?>"></td>
        <td> <input name="password" type="password" placeholder="password" id="user_password" ></td>
        <td><div class="form-group">
                <select name="opravnenie" class="custom-select">
                    <option selected=<?php echo $row["level_opravnenia"]?>><?php echo $row["level_opravnenia"]?></option>
                    <option value="poradatel">poradatel</option>
                    <option value="pokladni">pokladní</option>
                    <option value="divak">divak</option>
                    <option value="admin">admin</option>
                </select>
        </td>
        <td><button type="button" id="align-right" name="delete_btn" class="btn btn-danger" onclick="location.href='delete.php?type=USER&id=<?php echo $row["registrovany_ID"]?>'"> Odstrániť </button></td>
        <td><button type="submit" id="align-right" name="update" class="btn btn-info" onclick=""> Potvrdiť zmeny </button></td>
    </tr>
    </form>
    <?php
    }
    ?>
    </tbody>
</table>
