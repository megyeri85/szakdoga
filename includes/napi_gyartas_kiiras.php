<?php
include("functions.php");
session_start();
if (!jog_ellenorzes(ADMIN)) {
    die("jogtalan hozzáférés!");
}
include("connect.inc.php");


if (isset($_POST['datum'])) {
    $datum = explode("/", $conn->real_escape_string($_POST["datum"]));
    $sqldatum = $datum[2] . "-" . $datum[0] . "-" . $datum[1];
//    echo $sqldatum;
    $sql = "select kategoria_id,kategoria_nev, termek_nev, termek_suly , sum(db)
            from ((rendeles inner join rendelt_termek on rendeles_id = fk_rendeles_id) inner join termekek on termek_id=fk_termek_id) inner join termek_ketegoriak on kategoria_id=fk_kateg_id
            where datum='$sqldatum'
            group by termek_id
            order by kategoria_nev, termek_nev, termek_suly;";
    if($eredmeny= $conn->query($sql)) {
        $kategid = 0;
        echo "<table id='gyartas_tablazat'>";
        while ($sor = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
//            print_r($sor);
            if($kategid != $sor['kategoria_id']){
                echo "<tr><th colspan='3' style='text-align: center; text-transform: uppercase'; >".$sor['kategoria_nev']."</th></tr>";
                $kategid = $sor['kategoria_id'];
            }else{

            }
            echo "<tr>";
            echo "<td style='width: 300px'>".$sor['termek_nev']."</td>";
            echo "<td style='width: 100px'>".$sor['termek_suly']." Kg</td>";
            echo "<td style='width: 100px'>".$sor['sum(db)']." DB</td>";
            echo "</tr>";

        }
        echo "</table>";
    }else{
        echo "mysqlhiba";
    }
}else{
    echo "hibas adaatok";
}
?>

