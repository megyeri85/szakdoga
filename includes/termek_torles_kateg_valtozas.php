<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");

if (isset($_POST["kateg"])) {
    $kateg = $conn->real_escape_string($_POST["kateg"]);
    $sql="SELECT `termek_id` FROM `termekek` WHERE `fk_kateg_id`='$kateg'";
    $eredmeny= $conn->query($sql);
    $valasz= array();
    while ($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
        $valasz[]=$sor["termek_id"];
    }

    echo json_encode($valasz);
}
?>