<?php
include("/../includes/connect.inc.php");







    if (isset($_POST["kilepes"])) {
        session_destroy();
        $_SESSION = array();

    }
if(isset($_SESSION["sikeres_belepes"]) && $_SESSION["sikeres_belepes"]==true){
}else{

    if (!isset($_SESSION['belepes_probalkozas'])) {
        $_SESSION['belepes_probalkozas'] = 0;
        $_SESSION['sikeres_belepes'] = false;
        $_SESSION['jog'] = 0;
    }


    if (isset($_POST['nev']) && isset($_POST['jelszo']) && isset($_POST["g-recaptcha-response"])) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array('secret' => '6LeGjRETAAAAABypZNm_xWWHX5xKtZXeR-EUR-Yh', 'response' => $_POST["g-recaptcha-response"]);

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $result = json_decode($result, true);


        $nev = $_POST['nev'];
        $jelszo = $_POST['jelszo'];


        $lekerdezes = "select * from felhasznalok where nev='$nev' and jelszo=sha1('$jelszo')";
        $eredmeny = $conn->query($lekerdezes);
        $talalat = $eredmeny->num_rows;
        if ($talalat == 1 && $result["success"]) {
            $row = $eredmeny->fetch_array(MYSQLI_ASSOC);
            $_SESSION['belepett_felhasznalo'] = $nev;
            $_SESSION['sikeres_belepes'] = true;
            $_SESSION['felhasznalo_id'] = $row['felhasznalo_id'];
            $_SESSION['jog'] = $row['jog_szint'];
            //echo $_SESSION['belepett_felhasznalo']."névvel be vagy jelentkezve";
        } else {
            $_SESSION['sikeres_belepes'] = false;
            $_SESSION['belepes_probalkozas']++;
            //echo'Helytelen jelszó vagy felhasználói név';
        }

    }
}
?>