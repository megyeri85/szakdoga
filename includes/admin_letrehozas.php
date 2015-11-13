<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");


if (isset($_POST["felhasznalo_nev"]) && isset($_POST["jog"])) {
    $felhasznalo_nev = $conn->real_escape_string($_POST["felhasznalo_nev"]);
    $jog = $conn->real_escape_string($_POST["jog"]);
    $sql = "select count(*) as db  from `felhasznalok` where `nev`='$felhasznalo_nev'";
    $eredmeny = $conn->query($sql)->fetch_row()[0];
    if ($eredmeny > 0) {
        echo("Ilyen nevű felhasználó már van, válassz másik nevet!");
    } else {

    if (uresmezo_ellenorzes($felhasznalo_nev) && ($jog == 2 || $jog == 3)) {
        $ins = "INSERT INTO `felhasznalok`(`fk_vasarlo_id`, `nev`, `jelszo`, `jog_szint`) VALUES ('0','$felhasznalo_nev', sha1('$felhasznalo_nev'),'$jog')";
        if ($conn->query($ins)) {
            echo "Az új admin létrehozva";
        } else {
            echo "mysql hiba";
        }
    } else {
        echo("Hibás adatok");
    }
    }
}
?>