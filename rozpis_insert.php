<?php
require "classFestival.php";
require "classInterpret.php";
require_once "connect_db.php";
require_once "controller.php";

$pdo = connect_db();
$interpret = new Interpret();
$festival = new Festival();
$interpretArray = $interpret->getAllInterpret($pdo);
$podiumArray = getPodiaForFestival($pdo, $_GET['id']);
$festival->initExistingFestival($pdo,$_GET['id']);
$datumOd = date_parse_from_format('Y-m-d H:i:s', $festival->getDatum_Od($pdo));
$datumDo = date_parse_from_format('Y-m-d H:i:s', $festival->getDatum_Do($pdo));

for ($i = $datumOd['day']; $i <= $datumDo['day']; $i++) {
    $cnt = 0;
    if ($i == $datumOd['day']) {
        for ($j = $datumOd['hour']; $j < 24; $j++) {
            $cnt++;
        }
    }
    else if ($i != $datumDo['day']){
        for ($j = 0; $j < 24; $j++) {
            $cnt++;
        }
    }
    else {
        for ($j = 0; $j < $datumDo['hour']; $j++) {
            $cnt++;
        }
    }
    foreach ($podiumArray as $podium) {
        for ($k = 0; $k < $cnt; $k++) {
            $cas = $datumOd;
            if ($i == $datumOd['day']) {
                $cas['hour'] += $k;
            }
            elseif ($i != $datumDo['day']) {
                $cas['day'] += $i - $datumOd['day'];
                $cas['hour'] = $k;
            }
            else {
                $cas = $datumDo;
                $cas['hour'] = $k;
            }

            if ($_POST['select_interprets_timeslots'.$cas['day'].$cas['hour'].$podium->getNazov($pdo)] != ''){
                $error = insertInterpretForTime($pdo, $cas, $podium->getID(), $_POST['select_interprets_timeslots'.$cas['day'].$cas['hour'].$podium->getNazov($pdo)]);
                if ($error == 1){
                    throw new Exception("Nepodarilo sa vlozit interpreta");
                }
            }
            else{
                if (deleteInterpretForTime($pdo, $cas, $podium->getID()) == 1){
                    throw new Exception("Nepodarilo sa odstranit interpreta na podiu");
                }
            }
        }
    }
}
header("Location: admin.php");
die;
?>