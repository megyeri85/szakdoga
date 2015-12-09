<?php
include("../includes/connect.inc.php");
?>
<p id="datumfelirat">Válaszd ki a szállítás napját: </p>
<div class="container" style="display inherit">


    <input type="text" id="calendar3">
</div>


<input type="button" id="osszes_nyomtatas" class="mentes" value="Szállítólevelek Nyomtatása">

<!--<form id="invisible_form" action="includes/osszes_nyomtatpdf.php" method="post" target="_blank">-->
<form id="invisible_form" action="includes/szallitolevel_nyomtat.php" method="post" target="_blank">
    <input id="new_window_parameter_1" name="datum" type="hidden" value="default">
</form>

<script>
    $(document).ready(function () {
        $("#osszes_nyomtatas").click(osszes_nyomtatas);
        $("#osszes_nyomtatas").hide();
        var eventDates = {};


        $.ajax({
            type: "POST",
            url: "includes/napi_termeles_lista.php",
            data: {},
            datatype: "json",
            success: function (valasz) {
                valasztomb = JSON.parse(valasz);
                var eventDates = {};

                for (i = 0; i < valasztomb.length; i++) {
                    eventDates[new Date(valasztomb[i])] = new Date(valasztomb[i]);
                }


                jQuery('#calendar3').datepicker({
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


    });

    $("#calendar3").change(function () {
        var datum = ($("#calendar3").val());
//        console.log(datum);
        $.ajax({
            type: "POST",
            url: "includes/szallitolevel_vasarlok.php",
            data: {datum: datum},

            datatype: "json",
            success: function (valasz) {
                console.log(valasz);
            }
        });
        $("#osszes_nyomtatas").show();


    });

    function osszes_nyomtatas() {
        var datum = ($("#calendar3").val());

//        $('#new_window_parameter_1').val(datum);
//        $('#invisible_form').submit();

        $.ajax({
            type: "POST",
            url: "includes/szallitolevel_nyomtat.php",
            data: {datum: datum},


            success: function (valasz) {
                if (valasz == "0") {
                    alert("Erre a napra nincs rendelés!");
                }else{
                    $('#new_window_parameter_1').val(datum);
                    $('#invisible_form').submit();
                }
            }
        });

    }


</script>