<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");

if(isset($_POST["termek_id"])){
    $termek_id= $conn->real_escape_string($_POST["termek_id"]);
    $sql="SELECT * FROM `termekek` WHERE `termek_id`='$termek_id'";
    $eredmeny = $conn->query($sql)->fetch_array(MYSQLI_ASSOC);
    echo json_encode($eredmeny);
}




?>