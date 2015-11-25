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
//    print_r($eredmeny);
    $ujjelszo = generateRandomString(3);
//    echo $ujjelszo;
    $upd="UPDATE `felhasznalok` SET `jelszo`=sha1('$ujjelszo') WHERE `felhasznalo_id`='$id'";
    if($conn->query($upd)){
        echo"A ".$eredmeny["ceg_nev"]."nevű céghez tartozo ".$eredmeny["nev"]." felhasználó új jelszava a : ".$ujjelszo." .Melyet kiküldtünk a ".$eredmeny["ceg_email"]." címre";
        $message = $eredmeny["ceg_nev"]."nevű céghez tartozo ".$eredmeny["nev"]." felhasználó új jelszava a : ".$ujjelszo;

        mail($eredmeny["ceg_email"], 'Felhasználó létrehozva', $message);
        }else{
        echo "Mysql hiba!";
    }




}else{
    echo "Hiba történt";
}
?>