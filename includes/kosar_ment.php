<?php

include("connect.inc.php");
session_start();
if (!count($_SESSION ["kosar"]) > 0) {
    die();
}
if (isset($_POST['datum'])) {
    ;
    $datum = $conn->real_escape_string($_POST['datum']);
    $sql = sprintf("SELECT `fk_vasarlo_id` as  `vasarlo_id` FROM `felhasznalok` WHERE `felhasznalo_id`=%d ", $_SESSION['felhasznalo_id']);
    $vasasrlo_id = isset($_POST["vasarlo_id"])? $_POST["vasarlo_id"] : $conn->query($sql)->fetch_assoc()["vasarlo_id"];

    $sql = sprintf("SELECT * FROM `rendeles` WHERE `fk_vasarlo_id`=%d and `datum`='$datum'", $vasasrlo_id);
    $eredmeny = $conn->query($sql);
    $sorokszama = mysqli_num_rows($eredmeny);
    if ($sorokszama > 0) {
        $eredmeny = $eredmeny->fetch_array();
        $del = sprintf("DELETE FROM `rendeles` WHERE `rendeles_id`=%d", $eredmeny['rendeles_id']);
        $conn->query($del);
        $del2 = sprintf("DELETE FROM `rendelt_termek` WHERE `fk_rendeles_id`=%d", $eredmeny["rendeles_id"]);
        $conn->query($del2);

    }


    $sql = sprintf("INSERT INTO `rendeles`(`fk_felhasznalo_id`, `fk_vasarlo_id`, `datum`) VALUES (%d,%d ,'$datum')", $_SESSION['felhasznalo_id'],$vasasrlo_id);
    $conn->query($sql);
    $last_id = $conn->insert_id;
    $sql = "";
    foreach ($_SESSION["kosar"] as $key => $val) {
        $key = explode("_", $key)[1];
        $sql .= sprintf("INSERT INTO `rendelt_termek`(`fk_rendeles_id`, `db`, `fk_termek_id`) VALUES (%d,%d,%d);", $last_id, $val, $key);
    }
    $conn->multi_query($sql);
    unset($_SESSION["kosar"]);
}