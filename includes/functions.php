<?php

define( "ADMIN",  3);
define( "VASARLO",  1);
define( "DISZPECSER",  2);

function email_ellenorzes($emeailcim)
{
    return preg_match('/^[0-9a-z\.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$/', $emeailcim);
}

function uresmezo_ellenorzes($mezo)
{
    if (empty($mezo)) {
        return false;
    } else {
        return true;
    }
}

function telefonszam_ellenorzes($telefonszam)
{
    return preg_match('/^[0-9]{8,9}$/', $telefonszam);
}

function hany_szam_ellenorzes($szam, $hany)
{
    $minta = '/^[0-9]{' . $hany . '}$/';
    return preg_match($minta, $szam);
}

function generateRandomString($length)
{
//    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function get_amount($id)
{
    if (isset($_SESSION["kosar"][$id])) {
        return $_SESSION["kosar"][$id];
    } else {
        return 0;
    }
}

function jog_ellenorzes($jog)
{
    if (isset($_SESSION["sikeres_belepes"]) && isset($_SESSION["jog"]) && $_SESSION["sikeres_belepes"] == 1 && $_SESSION["jog"] == $jog) {
        return true;
    }
    return false;
}
function szam_ellenorzes($szam){

    return preg_match('/^[0-9]+$/', $szam);
}

function suly_ellenorzes($suly){
    if (preg_match('/^[1-9]+[0-9]*$/', $suly) || preg_match('/^\d+[.]\d{1,2}$/', $suly)){
        return true;
    }else{
        return false;
    }
}

function vasarlo_lista(){
    require("connect.inc.php");
echo "   <p id='datumfelirat'>Válaszd ki a vásárlót!</p>";
echo"<select id='vasarlo'>
                <option value='0'>Bármelyik</option>";


                $sql = "select * from vasarlok where vasarlo_id>0 order by ceg_nev";
                $vasarlok = $conn->query($sql);
                while ($vasarlo = $vasarlok->fetch_array(MYSQLI_ASSOC)) {
                    echo "<option value=" . $vasarlo["vasarlo_id"] . ">" . $vasarlo["ceg_nev"] . "</option>";
                }



echo"</select>";
}