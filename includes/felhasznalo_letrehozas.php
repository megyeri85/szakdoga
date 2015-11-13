<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)){die("jogtalan hozzáférés!");}
include("connect.inc.php");




if (isset($_POST['id'])) {
    $_POST['id'] = $conn->real_escape_string($_POST['id']);

    $sql = "SELECT `ceg_nev`, `ceg_email` FROM `vasarlok` WHERE `vasarlo_id`='" . $_POST['id'] . "'";


    if ($eredmeny = $conn->query($sql)) {
        $eredmeny = mysqli_fetch_array($eredmeny);
        $id = $_POST['id'];
        $emailcim = $eredmeny['ceg_email'];
        $cegnev = $eredmeny['ceg_nev'];
        $nevjelszo = generateRandomString(3);
        //Email küldés
        $ujfelhasznalo = "INSERT INTO `felhasznalok`(`fk_vasarlo_id`, `nev`, `jelszo`, `jog_szint`)
                        VALUES ('$id','$nevjelszo',sha1('$nevjelszo'),'1')";
        if ($conn->query($ujfelhasznalo)) {
            echo "Az új felhasznalo létrehozva";
        } else {
            echo "mysql hiba";
        }

    } else {
        echo "mysql hiba";
    }


}