<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)){die("jogtalan hozzáférés!");}

include("../includes/connect.inc.php");


foreach ($_POST as $kulcs => $ertek) {
    $_POST[$kulcs] = $conn->real_escape_string($_POST[$kulcs]);
}

extract($_POST);
$cegjegyzekszam = $cegjegyzekszam1 . $cegjegyzekszam2 . $cegjegyzekszam3;
$adoszam = $adoszam1 . $adoszam2 . $adoszam3;
$del = "DELETE FROM `vasarlok` WHERE `vasarlo_id`='$id' AND `ceg_cim`='$cim' AND `ceg_cegjegyzekszam`='$cegjegyzekszam' AND
        `ceg_adoszam`='$adoszam' AND `ceg_telefonszam`='$telefonszam' AND `ceg_email`='$email' ";
if($conn->query($del)){
    echo"A törlés sikeres";
}else{
    echo"A törlés sikertelen volt";
}