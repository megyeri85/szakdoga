<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)){die("jogtalan hozzáférés!");}

include("connect.inc.php");
if(isset($_POST['felhasznaloid'])){
    $felhasznaloid=$conn->real_escape_string($_POST['felhasznaloid']);
    $del="DELETE FROM `felhasznalok` WHERE `felhasznalo_id`='$felhasznaloid'";
    if($conn->query($del)){
        echo"A törlés sikeres";
    }else{
        echo"A törlés sikertelen";
    }

}else{
    echo"Hiba történt";
}


?>