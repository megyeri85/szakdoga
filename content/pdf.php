<?php

include("../includes/connect.inc.php");

require('../includes/mpdf60/mpdf.php');

if(isset($_POST["datum"]) && isset($_POST["txt"]) ) {
    $datum = explode("/", $conn->real_escape_string($_POST["datum"]));
    $ujdatum = $datum[2] . "-" . $datum[0] . "-" . $datum[1];
    $mpdf = new mPDF();
    $mpdf->WriteHTML('<style>table{ border-collapse: collapse;} table,td{border: 1px solid black;} th{font-size: 15px;}</style><h1 style="text-align: center">Gyártási lap</h1><h2 style="text-align: center">'.$ujdatum.'</h2><br><br><br><div style="margin-left: 100px ">' . $_POST["txt"] . '</div>');

    $mpdf->Output();
    exit;
}
?>