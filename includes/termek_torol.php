<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");
if(isset($_POST["id"])){
    $id = $conn->real_escape_string($_POST["id"]);
    $del="DELETE FROM `termekek` WHERE `termek_id`='$id'";
    if($conn->query($del)){
        echo"A termék törlése sikeres volt";
    }else{
        echo "Mysql hiba!";
    }
}else{
    echo "Hiba történt";
}

?>