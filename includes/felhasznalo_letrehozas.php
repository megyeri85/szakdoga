<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");


if (isset($_POST['id']) && isset($_POST["felhasznalo_nev"])) {
    $_POST['id'] = $conn->real_escape_string($_POST['id']);
    $felhasznalo_nev = $conn->real_escape_string($_POST['felhasznalo_nev']);

    $sql = "SELECT `ceg_nev`, `ceg_email` FROM `vasarlok` WHERE `vasarlo_id`='" . $_POST['id'] . "'";


    if ($eredmeny = $conn->query($sql)) {
        $eredmeny = mysqli_fetch_array($eredmeny);
        $id = $_POST['id'];
        $emailcim = $eredmeny['ceg_email'];
        $cegnev = $eredmeny['ceg_nev'];
        $nevjelszo = generateRandomString(3);
        //Email küldés
        $sql2 = "SELECT * FROM `felhasznalok` WHERE `nev`='$felhasznalo_nev'";
        $van_e = $conn->query($sql2);
        $ssz = mysqli_num_rows($van_e);
        if ($ssz > 0) {
            echo "Ilyen nevű felhasználó már létezik. Válassz másik nevet";
        } else {


            $ujfelhasznalo = "INSERT INTO `felhasznalok`(`fk_vasarlo_id`, `nev`, `jelszo`, `jog_szint`)
                        VALUES ('$id','$felhasznalo_nev',sha1('$felhasznalo_nev'),'1')";
            if ($conn->query($ujfelhasznalo)) {
                echo"Az új felhasznalo létrehozva: ".$felhasznalo_nev." névvel és ".$nevjelszo." jelszóval";
                $message = "Az új felhasznalo létrehozva: " . $felhasznalo_nev . " névvel és " . $nevjelszo . " jelszóval";

                mail($emailcim, 'Felhasználó létrehozva', $message);
            } else {
                echo "mysql hiba";
            }
        }

    } else {
        echo "mysql hiba";
    }


}