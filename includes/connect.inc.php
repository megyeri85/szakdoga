<?php
//adatbázis-kapcsolódás
$conn = new mysqli("localhost", "root", "", "pekseg");
if ($conn->connect_errno) {
    die("Adatbázis-kapcsolódási hiba: ".$conn->connect_error);
}
$conn->query("SET NAMES utf8 COLLATE utf8_hungarian_ci");
?>
