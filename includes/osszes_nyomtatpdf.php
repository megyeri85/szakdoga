<?php

include("../includes/connect.inc.php");

require('../includes/mpdf60/mpdf.php');

$mpdf = new mPDF();
if (isset($_POST["datum"])) {
    $datum = explode("/", $conn->real_escape_string($_POST["datum"]));
    $sqldatum = $datum[2] . "-" . $datum[0] . "-" . $datum[1];
    $sql = "SELECT * FROM `rendeles` inner join `rendelt_termek` on `fk_rendeles_id`=`rendeles_id` inner join `vasarlok` on `fk_vasarlo_id`=`vasarlo_id` inner join `termekek` on `fk_termek_id`=`termek_id` WHERE `datum`='$sqldatum' order by `vasarlo_id`";
    $eredmeny = $conn->query($sql);
    $html = "";
    $felhasznalo = "";
    while ($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
        if ($felhasznalo != $sor["ceg_nev"]) {
            if ($felhasznalo != '') {
                $html .= "</table><br><br><br><br><br><br><br><p>Átevette: ______________</p><pagebreak />";
            }
            $felhasznalo = $sor["ceg_nev"];
            $html .= "<h1 class='focim'>Szállítólevél</h1><h5>Megrendelő: $felhasznalo</h5><h5>Dátum: $sqldatum</h5><h5>Cím: {$sor['ceg_cim']}</h5>";
            $html .= "<table><tr><th>Termék név</th><th>Termék súly</th><th>Mennyiség</th></tr>";

        } else {
            $html .= "<tr>";
            $html .= "<td style='width: 300px'>" . $sor['termek_nev'] . "</td>";
            $html .= "<td style='width: 100px'>" . $sor['termek_suly'] . " Kg</td>";
            $html .= "<td style='width: 100px'>" . $sor['db'] . " DB</td>";
            $html .= "</tr>";
        }

    }

    $css = "
    <style>
table {
    border-collapse: collapse;
    margin: auto;
}

table, th, td {
    border: 1px solid black;
}
.focim{
text-align: center;
}

</style>
    ";
    $mpdf->WriteHTML($css . $html."</table><br><br><br><br><br><br><br><p>Átevette: ___________________________</p>");

    $mpdf->Output();
    exit;
}
?>