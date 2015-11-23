<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");

foreach ($_POST as $kulcs => $ertek) {
    $_POST[$kulcs] = $conn->real_escape_string($_POST[$kulcs]);
}
if (uresmezo_ellenorzes($_POST['termek_nev']) && szam_ellenorzes($_POST['termek_kateg']) && szam_ellenorzes($_POST['termek_ar']) && suly_ellenorzes($_POST['termek_suly'])) {

    extract($_POST);
$epsilon=0.00001;
    $sql = "SELECT *
            FROM `termekek`
            WHERE `termek_nev` LIKE '$termek_nev'
            AND `termek_suly` > $termek_suly - $epsilon
            AND `termek_suly` < $termek_suly + $epsilon"
            ;
    $eredmeny = $conn->query($sql);
    $ssz = mysqli_num_rows($eredmeny);

    if ($ssz > 0) {
        echo "Ilyen nevű és súlyú termék már létezik . ";
    } else {


        $sql = "INSERT INTO `termekek`(`termek_nev`, `termek_suly`, `termek_ar`, `fk_kateg_id`,`termek_leiras`)
          VALUES('$termek_nev', '$termek_suly', '$termek_ar', '$termek_kateg', '$termek_leiras')";
        if ($conn->query($sql)) {
            echo "A termék felvitele sikeres";
        }else{
            echo"Mysql hiba";
        }
    }
}


?>