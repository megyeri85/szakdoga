<?php
require("../includes/connect.inc.php");
session_start();
echo "<p id='osszesites'>Összesítés</p>";
echo "<table id='osszegzes'>";
$total = 0;
foreach ($_SESSION["kosar"] as $key => $value) {
    $termek_id = explode("_", $key)[1];
    $sql = "SELECT * FROM `termekek` WHERE `termek_id`='$termek_id'";
    $eredmeny = $conn->query($sql)->fetch_array();


    printf("<tr><td style='width: 360px'>%s</td><td style='width: 70px'>%s kg</td><td style='width: 70px'>%s Ft</td><td style='width: 70px'>%s db</td><td style='width: 70px'>%s Ft</td></tr>", $eredmeny["termek_nev"], $eredmeny["termek_suly"], $eredmeny["termek_ar"], $value, $eredmeny["termek_ar"] * $value);
    $total += $eredmeny["termek_ar"] * $value;

}
printf("<tr><td colspan='5'>TOTAL: %s FT</td></tr>", $total);
echo "</table>";

echo "<input type='button' id='submit' value='MEGRENDELÉS'>";
echo "<input type='button' id='megse' value='MÉGSE'>";

?>
<script>
    $("#megse").click(function () {
        $("#ellenorzes_div").html("");
        $("#rendeles").show();
    });

    $("#submit").click(function () {
//        var datum = $("#calendar").val();
        var vagottdatum = $("#calendar").val().split('/');

        var datum = vagottdatum[2] + "-" + vagottdatum[0] + "-" + vagottdatum[1];
        var data = {datum: datum};
        if ($("#vasarlo").exists()) {
            data['vasarlo_id'] = $("#vasarlo").val();
        }
        if (datum == "") {
            alert("Válassz egy dátumot");
        } else {


            if (confirm("Biztos benne?")) {
                $.ajax({
                    type: "POST",
                    data: data,
                    url: "includes/kosar_ment.php",


                    success: function (valasz) {
                        alert("Sikeres megrendelés");
                        location.reload();
                    }
                });
            }
        }

    });
</script>
