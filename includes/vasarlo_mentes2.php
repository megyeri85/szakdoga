<?php

include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)){die("jogtalan hozzáférés!");}
include("connect.inc.php");

foreach ($_POST as $kulcs => $ertek) {
    $_POST[$kulcs] = $conn->real_escape_string($_POST[$kulcs]);
}
if (uresmezo_ellenorzes($_POST['cim']) && telefonszam_ellenorzes($_POST['telefonszam']) &&
    hany_szam_ellenorzes($_POST['cegjegyzekszam1'], 2) && hany_szam_ellenorzes($_POST['cegjegyzekszam2'], 2) && hany_szam_ellenorzes($_POST['cegjegyzekszam3'], 6) &&
    hany_szam_ellenorzes($_POST['adoszam1'], 8) && hany_szam_ellenorzes($_POST['adoszam2'], 1) && hany_szam_ellenorzes($_POST['adoszam3'], 2)
    && email_ellenorzes($_POST['email'])
) {
    if (isset($_POST['id'])) {
        extract($_POST);
        $cegjegyzekszam = $cegjegyzekszam1 . $cegjegyzekszam2 . $cegjegyzekszam3;
        $adoszam = $adoszam1 . $adoszam2 . $adoszam3;
        $upd = "UPDATE `vasarlok` SET `ceg_cim`='$cim',`ceg_cegjegyzekszam`='$cegjegyzekszam',`ceg_adoszam`='$adoszam',`ceg_telefonszam`='$telefonszam',`ceg_email`='$email' WHERE `vasarlo_id`='$id'";

        if ($conn->query($upd)) {
            echo "Az adatok módosítása megtörtént";

        } else {
            echo "mysql hiba";
        }

    } elseif (isset($_POST['nev']) && uresmezo_ellenorzes($_POST['nev'])) {


        $sql = "SELECT * FROM `vasarlok` WHERE `ceg_nev`='" . $_POST['nev'] . "'";
        $eredmeny = $conn->query($sql);
        $sorokszama = mysqli_num_rows($eredmeny);

        if ($sorokszama != 0) {
            echo "Ilyen nevű vásárló már van";
        } else {
            extract($_POST);
            $cegjegyzekszam = $cegjegyzekszam1 . $cegjegyzekszam2 . $cegjegyzekszam3;
            $adoszam = $adoszam1 . $adoszam2 . $adoszam3;
            $sqlins = "INSERT INTO `vasarlok`(`ceg_nev`, `ceg_cim`, `ceg_cegjegyzekszam`, `ceg_adoszam`, `ceg_telefonszam`, `ceg_email`)
            VALUES ('$nev','$cim','$cegjegyzekszam','$adoszam','$telefonszam','$email')";
            if ($conn->query($sqlins)) {
                echo "A vásárló felvétele sikerült";
            } else {
                echo "A vásárló felvétele sikertelen volt";
            }
        }
    }
} else {
    echo "A bevitt adatok hibásak voltak!";
}


