<?php if(!isset($_POST["page"])){ die(0); }

    $page = htmlspecialchars($_POST["page"]);
    //print($page);

    $oldalak= array("vasarlo_felvitel","vasarlo_modositas","vasarlo_torles","felhasznalo_felvitel","felhasznalo_torles","kapcsolat","rendeles", "admin_felvitel","admin_torles","termek_felvitel","termek_torles","termek_modositas","napi_termeles","napi_gyartas","jelszo_valtoztatas","felhasznalo_jelszokuldes","hirek_szerkesztese","szallitolevelek");

    if(in_array( $page , $oldalak)){
        include("../content/$page.php");
    }