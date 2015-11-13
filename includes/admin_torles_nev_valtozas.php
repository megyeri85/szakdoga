<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}

include("connect.inc.php");

if (isset($_POST["admin_id"])) {
    $admin_id = $conn->real_escape_string($_POST["admin_id"]);
    $sql = "SELECT `jog_szint` FROM `felhasznalok` WHERE `felhasznalo_id`='$admin_id'";
    $eredmeny = $conn->query($sql)->fetch_row()[0];
    echo($eredmeny);
}


?>