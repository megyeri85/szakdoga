<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");
if(isset($_POST["id"]) && isset($_POST["ar"]) && isset($_POST["leiras"]) && szam_ellenorzes($_POST['ar'])){
    $id = $conn->real_escape_string($_POST["id"]);
    $ar = $conn->real_escape_string($_POST["ar"]);
    $leiras = $conn->real_escape_string($_POST["leiras"]);

    $upd="UPDATE `termekek` SET `termek_ar`='$ar',`termek_leiras`='$leiras' WHERE `termek_id`='$id'";
    if($conn->query($upd)){
        echo"A termék adatainak módosítása sikeres!";
    }else{
        echo"Mysql hiba";
    }
}else{
    echo"Hiba történt";
}
?>