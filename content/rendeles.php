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
<!--    <input type="date" id="datum">-->

    <div class="container" style="display inherit">


        <input type='text' id='calendar'>
    </div>

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
                printf("<tr><td style='width: 280px'>%s</td><td style='width: 20px'><img src='style/images/question.png' height='12' width='12' title='{$termek['termek_leiras']}'></td><td style='width: 100px' >%s Kg</td><td style='width: 120px'>%s Ft</td><td><input class='minusz' type='button' value='-'><input style='width: 32px; text-align: center;' value=%d  id='termek_%s' class='db' onkeypress='return event.charCode >= 48 && event.charCode <= 57'><input class='plusz' type='button' value='+'></td></tr>",
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

    $("#vasarlo").change(function () {
        if ($("#calendar").val() != "") {
            $("#calendar").trigger("change");




        }
        if($("#vasarlo").val()==0){
            $("#calendar").val("");
            $("#accordion").hide();
            $("input[name='mentes']").hide();
        }else{
            var vasarlo_id=$("#vasarlo").val();

            $.ajax({
                type: "POST",
                url: "includes/datum_rendeles_jelol.php",
                data: {vasarlo_id: vasarlo_id},
                datatype: "json",
                success: function (valasz) {
                    var valasztomb =  JSON.parse(valasz);

                    var eventDates = {};
                    for(i=0; i<valasztomb.length;i++){
                        var vagottdatum = valasztomb[i].split("-");
                        var datum = vagottdatum[1] + "/" + vagottdatum[2] + "/" + vagottdatum[0];
//                        console.log(datum);
                        eventDates[new Date(datum)] =new Date(datum);
                    }
                    $(".container").html("<input type='text' id='calendar'>");
                    jQuery('#calendar').datepicker({
                        beforeShowDay: function (date) {
                            var highlight = eventDates[date];
                            if (highlight) {
                                return [true, "event", "highlight"];
                            } else {
                                return [true, '', ''];
                            }
                        }
                    });
                }
            });
        }
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
//        console.log($(this).attr('id') + "    " + $(this).val());
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
//    $("#datum").change(function () {
//        var datum = $("#datum").val();
//        var mainap = Date.today();
//        var data = {datum: datum};
//        $(".db").val(0);
//        if ($("#vasarlo").exists()) {
//            data['vasarlo_id'] = $("#vasarlo").val();
//        }
//
//        if (Date.compare(Date.parse(datum), mainap) == 0) {
//            alert("A mai napra nem lehet rendelni");
//
//            $("#datum").val("");
//        } else {
//            if (Date.compare(Date.parse(datum), mainap) == 1) {
//                $("#accordion").show();
//                $("input[name='mentes']").show();
//
//                $.ajax({
//                    type: "POST",
//                    data: data,
//                    url: "includes/datum_rendeles_ellenoriz.php",
//
//
//                    success: function (valasz) {
//                        if (!valasz) {
//                            console.log("nincs valasz");
//                        } else if (valasz == "[]") {
//                            console.log("üres a nap");
//                            $(".db").val(0);
//                        } else {
//
//                            if (confirm("Erre a napra már van rendelésed. Szeretnéd módosítani?")) {
//                                console.log("szeretne");
//
//                                var valasztomb = JSON.parse(valasz);
////                            console.log(valasztomb);
//
//                                for (var kulcs in valasztomb) {
////                                console.log(kulcs + " " + valasztomb[kulcs]);
//                                    $("#termek_" + kulcs).val(valasztomb[kulcs]);
//
//                                }
//                            } else {
//                                $("#datum").val("");
//                                $("#accordion").hide();
//                                $("input[name='mentes']").hide();
//
//                            }
//                        }
//                    }
//                });
//
//            } else {
//                if (Date.compare(Date.parse(datum), mainap) == -1) {
//                    alert("Rendelni csak későbbi időpontra lehet");
//                    $("#datum").val("");
//                }
//            }
//        }
////        console.log(mainap);
////        console.log(Date.parse(datum));
//    });


    $(document).on("change","#calendar",function(){

        if($("#vasarlo").val()== 0 || $("#calendar").val()== ""){
            $("accordion").hide();
            $("input[name='mentes']").hide();
        }else {
            var vagottdatum = $("#calendar").val().split('/');

            var datum = vagottdatum[2] + "-" + vagottdatum[0] + "-" + vagottdatum[1];

//            console.log(datum + "dd");























            var mainap = Date.today();
            var data = {datum: datum};
            $(".db").val(0);
            if ($("#vasarlo").exists()) {
                data['vasarlo_id'] = $("#vasarlo").val();
            }

            if (Date.compare(Date.parse(datum), mainap) == 0) {
                alert("A mai napra nem lehet rendelni");

                $("#calendar").val("");
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
//                                console.log("nincs valasz");
                            } else if (valasz == "[]") {
//                                console.log("üres a nap");
                                $(".db").val(0);
                            } else {

                                if (confirm("Erre a napra már van rendelésed. Szeretnéd módosítani?")) {
//                                    console.log("szeretne");

                                    var valasztomb = JSON.parse(valasz);
//                            console.log(valasztomb);

                                    for (var kulcs in valasztomb) {
//                                console.log(kulcs + " " + valasztomb[kulcs]);
                                        $("#termek_" + kulcs).val(valasztomb[kulcs]);

                                    }
                                } else {
                                    $("#calendar").val("");
                                    $("#accordion").hide();
                                    $("input[name='mentes']").hide();

                                }
                            }
                        }
                    });

                } else {
                    if (Date.compare(Date.parse(datum), mainap) == -1) {
                        alert("Rendelni csak későbbi időpontra lehet");
                        $("#calendar").val("");
                    }
                }
            }


        }

    });


    $(document).ready(function () {
        $("#accordion").hide();
        $("input[name='mentes']").hide();
//        $('[class^=ui]').removeClass("ui-accordion-header ui-state-default ui-accordion-header-active ui-state-active ui-corner-top ui-accordion-icons ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active ui-widget ui-accordion ui-widget ")

        if(!$("#vasarlo").exists()){
            $.ajax({
                type: "POST",
                url: "includes/datum_rendeles_jelol.php",
                data: {},
                datatype: "json",
                success: function (valasz) {
                    var valasztomb =  JSON.parse(valasz);

                    var eventDates = {};
                    for(i=0; i<valasztomb.length;i++){
                        var vagottdatum = valasztomb[i].split("-");
                        var datum = vagottdatum[1] + "/" + vagottdatum[2] + "/" + vagottdatum[0];
//                        console.log(datum);
                        eventDates[new Date(datum)] =new Date(datum);
                    }
                    $(".container").html("<input type='text' id='calendar'>");
                    jQuery('#calendar').datepicker({
                        beforeShowDay: function (date) {
                            var highlight = eventDates[date];
                            if (highlight) {
                                return [true, "event", "highlight"];
                            } else {
                                return [true, '', ''];
                            }
                        }
                    });
                }
            });
        }

        var eventDates = {};
        jQuery('#calendar').datepicker({
            beforeShowDay: function (date) {
                var highlight = eventDates[date];
                if (highlight) {
                    return [true, "event", "highlight"];
                } else {
                    return [true, '', ''];
                }
            }
        });





    });
    //    $(function() {
    //        $( "#datum" ).datepicker();
    //    });
</script>