
<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}

include("connect.inc.php");

if(isset($_POST["admin_jog"])){
    $admin_jog= $conn->real_escape_string($_POST["admin_jog"]);
    $sql="SELECT `felhasznalo_id` FROM `felhasznalok` WHERE `jog_szint`='$admin_jog'";
    $eredmeny=$conn->query($sql);
    $valasz=array();
    while($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)){

        $valasz[]=$sor["felhasznalo_id"];
    }
    echo json_encode($valasz);
}



?>