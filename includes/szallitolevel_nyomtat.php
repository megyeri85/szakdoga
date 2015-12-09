<?php

include("../includes/connect.inc.php");

require('../includes/mpdf60/mpdf.php');

$mpdf = new mPDF();

if (isset($_POST["datum"])) {
    $datum = explode("/", $conn->real_escape_string($_POST["datum"]));
    $sqldatum = $datum[2] . "-" . $datum[0] . "-" . $datum[1];
    $sql="SELECT * FROM `rendeles` inner join `vasarlok` on `vasarlo_id`=`fk_vasarlo_id` WHERE `datum`='$sqldatum'";
    $eredmeny=$conn->query($sql);
    $eredmenydb=mysqli_num_rows($eredmeny);
    if($eredmenydb > 0) {

        $html="";
        while($sor=$eredmeny->fetch_array(MYSQLI_ASSOC)){
            $html .= "<h1 class='focim'>Szállítólevél</h1><h5>Megrendelő: {$sor['ceg_nev']}</h5><h5>Dátum: $sqldatum</h5><h5>Cím: {$sor['ceg_cim']}</h5>";
            $html .= "<table><tr><th>Termék név</th><th>Termék súly</th><th>Mennyiség</th></tr>";
            $sql2="SELECT * FROM `rendelt_termek` inner join `termekek` on `fk_termek_id`=`termek_id` WHERE `fk_rendeles_id`={$sor['rendeles_id']} order by `fk_kateg_id`,`termek_nev`,`termek_suly`";
            $eredmeny2=$conn->query($sql2);
            while($sor2 = $eredmeny2->fetch_array(MYSQLI_ASSOC)){
                $html .= "<tr>";
                $html .= "<td style='width: 300px'>" . $sor2['termek_nev'] . "</td>";
                $html .= "<td style='width: 100px'>" . $sor2['termek_suly'] . " Kg</td>";
                $html .= "<td style='width: 100px'>" . $sor2['db'] . " DB</td>";
                $html .= "</tr>";
            }
            $html.="</table><br><br><br><br><br><br><br><p>Átevette: ______________</p><pagebreak />";
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
        $mpdf->WriteHTML($css . $html);

        $mpdf->Output();
        exit;


    }else{
        echo "0";
    }
}

?>