<?php
include("../includes/connect.inc.php");
?>
<p id="datumfelirat">Válaszd ki a szállítás napját: </p>
<div class="container" style="display inherit">


    <input type="text" id="calendar">
</div>



<input type="button" id="osszes_nyomtatas" class="mentes" value="Szállítólevelek Nyomtatása">

<form id="invisible_form" action="includes/osszes_nyomtatpdf.php" method="post" target="_blank">
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


    });

    $("#calendar").change(function () {
        var datum = ($("#calendar").val());
        console.log(datum);
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

    function osszes_nyomtatas(){
        var datum = ($("#calendar").val());

        $('#new_window_parameter_1').val(datum);
        $('#invisible_form').submit();

    }


</script>