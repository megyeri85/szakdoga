<?php
include_once("connect.inc.php");
session_start();
if (isset($_POST["datum"])) {
    $datum = $conn->real_escape_string($_POST["datum"]);
    $felhasznalo_id = $_SESSION["felhasznalo_id"];
    $_SESSION["kosar"] = array();
    $sql = sprintf("SELECT `fk_vasarlo_id` as  `vasarlo_id` FROM `felhasznalok` WHERE `felhasznalo_id`=%d ", $_SESSION['felhasznalo_id']);
    $vasasrlo_id = isset($_POST["vasarlo_id"]) ? $_POST["vasarlo_id"] : $conn->query($sql)->fetch_assoc()["vasarlo_id"];
    $rendelesek = array();

//    echo $_SESSION["felhasznalo_id"];
    $sql = "SELECT * FROM `rendeles` WHERE `fk_vasarlo_id`='$vasasrlo_id' and `datum`='$datum'";
    $eredmeny = $conn->query($sql);
    $sorokszama = mysqli_num_rows($eredmeny);
    if ($sorokszama > 0) {
        $eredmeny = $eredmeny->fetch_array();
//        print_r($eredmeny);
        $sql2 = sprintf("SELECT * FROM `rendelt_termek` WHERE `fk_rendeles_id`= %d", $eredmeny["rendeles_id"]);
         $eredmeny2= $conn->query($sql2);
        while ($sor = $eredmeny2->fetch_array()) {
//            echo $sor["fk_termek_id"];
//            echo $sor["db"];
            $rendelesek[$sor['fk_termek_id']] = $sor['db'];
            $_SESSION["kosar"]["termek_".$sor['fk_termek_id']] = $sor['db'];
        }
        echo json_encode($rendelesek);

    }


}