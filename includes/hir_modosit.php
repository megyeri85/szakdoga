<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");

if (isset($_POST["hir1"]) && isset($_POST["hir2"]) && isset($_POST["hir3"])){
    $hir1 = $conn->real_escape_string($_POST["hir1"]);
    $hir2 = $conn->real_escape_string($_POST["hir2"]);
    $hir3 = $conn->real_escape_string($_POST["hir3"]);
    $sql1="UPDATE `hirek` SET `hir_szoveg`='$hir1' WHERE `hir_id`=1";
    $sql2="UPDATE `hirek` SET `hir_szoveg`='$hir2' WHERE `hir_id`=2";
    $sql3="UPDATE `hirek` SET `hir_szoveg`='$hir3' WHERE `hir_id`=3";
    if($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3)){
        echo"A hírek módosítása megtörtént!";
    }else{
        echo "Mysqlhiba";
    }

}


?>