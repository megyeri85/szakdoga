<?php

include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}

include("connect.inc.php");

if (isset($_POST["admin_id"])) {
    $admin_id = $conn->real_escape_string($_POST["admin_id"]);
    $sql="DELETE FROM `felhasznalok` WHERE `felhasznalo_id`='$admin_id'";
    if($conn->query($sql)){
        echo ("A törlés sikeres volt.");
    }else{
        echo("mysql hiba");
    }
} else {
    echo("Hibás adatok!");
}
?>