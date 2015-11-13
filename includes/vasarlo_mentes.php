<?php
    include("connect.inc.php");
    include("functions.php");

    $error = [];
    foreach ( array_keys($_POST) as $key){
        $_POST[$key] = $conn->real_escape_string($_POST[$key]);
    }



    if(isset($_POST["id"])){
        extract($_POST);
        if (!email_ellenorzes($email))
            $error[] = "emailcim";
        if (!count($error)) {
            $cegjegyzekszam = $cegjegyzekszam1 . $cegjegyzekszam2 . $cegjegyzekszam3;
            $adoszam = $adoszam1 . $adoszam2 . $adoszam3;
            $sql = "UPDATE `vasarlok` SET `ceg_cim`='$cim',`ceg_cegjegyzekszam`='$cegjegyzekszam',`ceg_adoszam`='$adoszam',`ceg_telefonszam`='$telefonszam',`ceg_email`='$email' WHERE `vasarlo_id`='$id'";
            $conn->query($sql);
            if ($conn->error){
                echo (json_encode(['mysql_error']));
            }else echo json_encode(array());
        }else{
            echo json_encode($error);

        }
     }
?>

