<?php

include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");

if(isset($_POST["felhasznaloid"])){
    $id = $conn->real_escape_string($_POST["felhasznaloid"]);
    $sql="SELECT `ceg_email`,`ceg_nev`,`nev` FROM `vasarlok` inner join `felhasznalok` on `vasarlo_id`=`fk_vasarlo_id` WHERE `felhasznalo_id`='$id'";
    $eredmeny=$conn->query($sql)->fetch_array(MYSQLI_ASSOC);
    print_r($eredmeny);
    $ujjelszo = generateRandomString(5);
    echo $ujjelszo;
    $upd="UPDATE `felhasznalok` SET `jelszo`=sha1('aaa') WHERE `felhasznalo_id`='$id'";
    if($conn->query($upd)){
        echo"A módosítás sikeres volt!";
    }else{
        echo "Mysql hiba!";
    }




}else{
    echo "Hiba történt";
}
?>