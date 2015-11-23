<?php


require('../includes/mpdf60/mpdf.php');

$mpdf = new mPDF();
$mpdf->WriteHTML('<style>table{font-size: 30px}</style><h1 style="color:red; text-align: center">Gyártás</h1><br><div style="margin-left: 100px ">'.$_POST["txt"].'</div>');

$mpdf->Output();
exit;
?>