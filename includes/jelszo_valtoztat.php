<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN) && !jog_ellenorzes(DISZPECSER) && !jog_ellenorzes(VASARLO) ){die("jogtalan hozzáférés!");}
include("connect.inc.php");

if(isset($_POST["regi_jelszo"]) && isset($_POST["uj_jelszo"]) && isset($_POST["uj_jelszo2"]) && $_POST["uj_jelszo"]== $_POST["uj_jelszo2"]){
    $regi_jelszo = $conn->real_escape_string($_POST["regi_jelszo"]);
    $uj_jelszo = $conn->real_escape_string($_POST["uj_jelszo"]);
    $uj_jelszo2 = $conn->real_escape_string($_POST["uj_jelszo2"]);
    $id = $_SESSION["felhasznalo_id"];
    $upd="UPDATE `felhasznalok` SET `jelszo`=sha1('$uj_jelszo')  WHERE `felhasznalo_id`='$id' and `jelszo`=sha1('$regi_jelszo')";
    if( $conn->query($upd)=== true){
        echo"siker";

    }else{
        echo "Hiba történt";
    }

}else{
    echo"Hibás adatok";
}



?>