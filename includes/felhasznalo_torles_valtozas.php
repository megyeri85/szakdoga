<?php
include("connect.inc.php");
if (isset($_POST["felhasznaloid"])) {

    $felhasznaloid=$conn->real_escape_string($_POST['felhasznaloid']);

    $sql="SELECT `fk_vasarlo_id` FROM `felhasznalok` WHERE `felhasznalo_id`='$felhasznaloid'";
    $eredmeny=$conn->query($sql);
    $eredmeny=mysqli_fetch_array($eredmeny);
    $sql2="SELECT `vasarlo_id`,`ceg_nev` FROM `vasarlok` WHERE `vasarlo_id`='".$eredmeny['fk_vasarlo_id']."'";
    $eredmeny2=$conn->query($sql2);
    $eredmeny2=mysqli_fetch_array($eredmeny2);
    echo $eredmeny2['vasarlo_id'];

}elseif(isset($_POST['vasarloid'])){
//    echo"van vasarloid";
    $vasarloid=$conn->real_escape_string($_POST['vasarloid']);
    $sql="SELECT `felhasznalo_id`,`nev` FROM `felhasznalok` WHERE `fk_vasarlo_id`='$vasarloid'";
    $eredmeny=$conn->query($sql);
    $valasz=array();
    while ($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
//        echo $sor['felhasznalo_id'];
//        echo $sor['nev'];
        $valasz[ $sor['felhasznalo_id']] = $sor['nev'] ;

    }
//    print_r($valasz);
   echo json_encode($valasz);

}