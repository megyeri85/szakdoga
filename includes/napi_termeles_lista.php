<?php
//$t = array();
//$t[] = "11/28/2015" ;
//$t[] = "11/23/2015" ;
//$t[] = "11/22/2015" ;
//echo json_encode($t);


include("../includes/connect.inc.php");
$kimenet = array();
$sql="SELECT Distinct `datum` FROM `rendeles` order by datum ";
            $eredmeny= $conn->query($sql);

            while ($datum = $eredmeny->fetch_array(MYSQLI_ASSOC)) {

//                    print_r($datum['datum']);
                    $vagottdatum = explode("-",$datum['datum']);
                   $kimenet[]= $vagottdatum[1]."/".$vagottdatum[2]."/".$vagottdatum[0];


                }
            echo json_encode($kimenet);
?>