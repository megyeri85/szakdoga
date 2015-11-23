<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN) && !jog_ellenorzes(DISZPECSER)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");


if (isset($_POST['datum'])) {
    $datum = explode("/", $conn->real_escape_string($_POST["datum"]));
    $sqldatum = $datum[2] . "-" . $datum[0] . "-" . $datum[1];
    $valasz = array();

    $sql="SELECT `ceg_nev` FROM `rendeles` inner join vasarlok on `fk_vasarlo_id`=`vasarlo_id` WHERE `datum`='$sqldatum'";
    $eredmeny=$conn->query($sql);
    while ($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
        $valasz[]=$sor["ceg_nev"];
    }
    echo json_encode($valasz);
}
?>