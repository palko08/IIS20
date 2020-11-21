<?php
require "classInterpret.php";
require_once "connect_db.php";

$pdo = connect_db();
$interpret = new Interpret();
$interpret->initExistingInterpret($pdo,$_POST['select_interprets_timeslots1']);
?>