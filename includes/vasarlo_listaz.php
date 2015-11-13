<?php
    include("connect.inc.php");
    if(isset($_POST["id"])){
    $vasarlo_id= $conn->real_escape_string($_POST["id"]);
    $sql="SELECT * FROM `vasarlok` WHERE `vasarlo_id`=$vasarlo_id";
        $eredmeny = $conn->query($sql);
        $a = $eredmeny->fetch_array(MYSQLI_ASSOC);

        echo json_encode(
            array(
                "ceg_cegjegyzekszam" => $a["ceg_cegjegyzekszam"],
                "ceg_adoszam" => $a["ceg_adoszam"],
                "ceg_nev" => $a["ceg_nev"],
                "ceg_cim" => $a["ceg_cim"],
                "ceg_telefonszam" => $a["ceg_telefonszam"],
                "ceg_email" => $a["ceg_email"]
            )
        );
    }

?>