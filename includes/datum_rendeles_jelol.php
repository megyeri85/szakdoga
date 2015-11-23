<?php

include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN) && !jog_ellenorzes(DISZPECSER) && !jog_ellenorzes(VASARLO)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");

if(isset($_POST["vasarlo_id"])) {
    $vasarlo_id = $conn->real_escape_string($_POST["vasarlo_id"]);
}else{
    $sql=sprintf("SELECT `fk_vasarlo_id` FROM `felhasznalok` WHERE `felhasznalo_id`=%s",$_SESSION["felhasznalo_id"]);
    $eredmeny=$conn->query($sql)->fetch_array(MYSQLI_ASSOC);
    $vasarlo_id=$eredmeny["fk_vasarlo_id"];
}
   $sql="SELECT `datum` FROM `rendeles` WHERE `fk_vasarlo_id`='$vasarlo_id' order by `datum`";
    $eredmeny= $conn->query($sql);
    $sorsz=mysqli_num_rows($eredmeny);
    if ($sorsz > 0) {
        $valasz = array();
        while ($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
            $valasz[]= $sor["datum"];
        }
        echo json_encode($valasz);
    }






?>