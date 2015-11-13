<?php
session_start();
require_once("connect.inc.php");
require_once("functions.php");


?>
<div id="rendeles">
    <?php
    if (jog_ellenorzes(ADMIN) || jog_ellenorzes(DISZPECSER)) {
        vasarlo_lista();
    }
    ?>


    <p id="datumfelirat">Válaszd ki a kiszállítás napját:</p>
    <input type="date" id="datum">

    <div id="accordion">
        <?php


        $sql = "SELECT * FROM `termek_ketegoriak` order by kategoria_nev ";
        $eredmeny = $conn->query($sql);
        while ($kategek = $eredmeny->fetch_array(MYSQLI_ASSOC)) {
            echo "<h3 id='kateg_'" . $kategek['kategoria_id'] . ">" . $kategek['kategoria_nev'] . "</h3>";
            echo "<div>";
            $sql = sprintf("SELECT * FROM `termekek` WHERE `fk_kateg_id`=%d order by termek_nev, termek_suly", $kategek['kategoria_id']);
            $eredmeny2 = $conn->query($sql);
            echo "<table>";
            while ($termek = $eredmeny2->fetch_array(MYSQLI_ASSOC)) {
                printf("<tr><td style='width: 425px'>%s</td><td style='width: 80px'>%s Kg</td><td style='width: 80px'>%s Ft</td><td><input class='minusz' type='button' value='-'><input value=%d  id='termek_%s' class='db' style='text-align: center'><input class='plusz' type='button' value='+'></td></tr>",
                    $termek['termek_nev'], $termek['termek_suly'], $termek['termek_ar'], get_amount("termek_" . $termek['termek_id']), $termek['termek_id']);
            }
            echo "</table>";


            echo "</div>";
        }

        ?>

    </div>

    <input type="button" id="ellenoriz" name="mentes" class="mentes" value="Megrendelés">
</div>
<div id="ellenorzes_div">

</div>

<script>


    $(function () {
        $("#accordion").accordion({
            heightStyle: "content"
        });
    });


    $(".minusz").click(function () {
        var db = $(this).parent().find(".db");
        var akt = db.val() * 1;
        akt = akt < 1 ? 0 : akt - 1;
        db.val(akt);
        db.trigger('change');


    });
    $(".plusz").click(function () {
        var db = $(this).parent().find(".db");
        var akt = db.val() * 1;
        akt = akt < 1 ? 1 : akt + 1;
        db.val(akt);
        db.trigger('change');
//        kosar_frissites(db.attr('id'), akt);
    });

    $(".db").change(function () {
        kosar_frissites($(this).attr('id'), $(this).val());
        console.log($(this).attr('id') + "    " + $(this).val());
    });

    $("#ellenoriz").click(function () {
        $.ajax({
            type: "POST",
            url: "content/vasarlas_megerosit.php",
            success: function (valasz) {
                $("#ellenorzes_div").html(valasz);
                $("#rendeles").hide();
            }
        });
    });


    $.fn.exists = function () {
        return this.length !== 0;
    }
    $("#datum").change(function () {
        var datum = $("#datum").val();
        var mainap = Date.today();
        var data = {datum: datum};
        if ($("#vasarlo").exists()) {
            data['vasarlo_id'] = $("#vasarlo").val();
        }

        if (Date.compare(Date.parse(datum), mainap) == 0) {
            alert("A mai napra nem lehet rendelni");

            $("#datum").val("");
        } else {
            if (Date.compare(Date.parse(datum), mainap) == 1) {
                $("#accordion").show();
                $("input[name='mentes']").show();

                $.ajax({
                    type: "POST",
                    data: data,
                    url: "includes/datum_rendeles_ellenoriz.php",


                    success: function (valasz) {
                        if (!valasz) {
                            console.log("nincs valasz");
                        } else {
                            if (confirm("Erre a napra már van rendelésed. Szeretnéd módosítani?")) {
                                console.log("szeretne");

                                var valasztomb = JSON.parse(valasz);
//                            console.log(valasztomb);

                                for (var kulcs in valasztomb) {
//                                console.log(kulcs + " " + valasztomb[kulcs]);
                                    $("#termek_" + kulcs).val(valasztomb[kulcs]);

                                }
                            } else {
                                $("#datum").val("");
                                $("#accordion").hide();
                                $("input[name='mentes']").hide();

                            }
                        }
                    }
                });

            } else {
                if (Date.compare(Date.parse(datum), mainap) == -1) {
                    alert("Rendelni csak későbbi időpontra lehet");
                    $("#datum").val("");
                }
            }
        }
//        console.log(mainap);
//        console.log(Date.parse(datum));
    });

    $(document).ready(function () {
        $("#accordion").hide();
        $("input[name='mentes']").hide();
    });

</script>