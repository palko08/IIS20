<?php
require "common.php";
require "services.php";

make_header();

$serv = new AccountService();
$edit = false;
?>
<script src="view/show_elements.js"></script>
<meta http-equiv="refresh" content="600;url=logout.php" />
<link rel="stylesheet" href="view/css/style_profile.css">
<body class="profile-body">
<div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                    <div class="file btn btn-lg btn-primary">
                        Change Photo
                        <input type="file" name="file"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="profile-head">
                    <h5>
                        <?php
                        $person = $serv->getAccount($_SESSION['user']);
                        $name = $serv->getName($_SESSION['user']);
                        echo $name;
                        ?>
                    </h5>
                    <h6>
                        nejake bio
                    </h6>
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab">About</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-4">
                <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Upravit profil" onclick="show_edit();return false;"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4" style="padding-left: 10%;">
                <a href="tickets.php">Spravovať rezervácie</a>
                <br>
                <?php
                if ($person['level_opravnenia'] != 'divak') {
                    echo '<a href="admin.php">Admin Page</a><br>';
                }
                ?>
                <a href="logout.php">Logout</a>
            </div>
            <form name="edit_profile" method="post" action='update_users.php?login=<?php echo $person["login"]?>&id=<?php echo $person["registrovany_ID"]?>'>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                        <div class="row">
                            <div class="col-md-6">
                                <label>User Id</label>
                            </div>
                            <div class="col-md-6" >
                                <input type="text" name="login" id="edit_login" placeholder=<?php echo
                                $person['login']; ?>>
                                    <p id="show_login"><?php
                                        echo $person['login'];
                                        ?>
                                    </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Name</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="name" id="edit_name" placeholder=<?php echo
                                $name; ?>>
                                <p id="show_name">
                                    <?php
                                    echo $name;
                                    ?>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>Email</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="email" id="edit_email" placeholder=<?php
                                echo $person['email'];?>>
                                <p id="show_email">
                                    <?php
                                    echo $person['email'];
                                    ?>
                                </p>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Heslo</label>
                        </div>
                        <div class="col-md-6">
                            <input type="password" name="password" id="edit_heslo">
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn btn-info" id="confirm_changes" type="submit" name="update" value="update" onclick="">Potvrdit zmeny</button>
            </div>
            </form>
        </div>
    </form>
</div>
</body>

<?php

make_footer();
?>
