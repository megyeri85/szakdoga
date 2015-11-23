<?php
include("connect.inc.php");
session_start();

if(isset($_POST["regi_jelszo"])){
    $regi_jelszo= $conn->real_escape_string($_POST["regi_jelszo"]);

    $felhasznalo_id = $_SESSION["felhasznalo_id"];
    $sql="SELECT count(*) FROM `felhasznalok` WHERE `felhasznalo_id`='$felhasznalo_id' and `jelszo`=sha1('$regi_jelszo')";
    $eredmeny = $conn->query($sql)->fetch_array(MYSQLI_ASSOC);
    if($eredmeny["count(*)"]==0){
       $valasz = false;

    }elseif($eredmeny["count(*)"]==1){
        $valasz = true;

    }
    echo $valasz;
}


?>