<?php
include("../includes/connect.inc.php");
?>
<p id="datumfelirat">Válaszd ki a termelés napját: </p>
<div class="container" style="display inherit">


    <input type="text" id="calendar">
</div>

<div id="napi_gyartas_tablazat">

</div>

<input type="button" id="nyomtatas"  class="mentes" value="Nyomtatás">
<form id="invisible_form" action="content/pdf.php" method="post" target="_blank">
    <input id="new_window_parameter_1" name="txt" type="hidden" value="default">
</form>

<script>
    $(document).ready(function () {
        $("#nyomtatas").hide();
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

    $("#calendar").change(function (){
       var datum = ($("#calendar").val());
        $.ajax({
            type: "POST",
            url: "includes/napi_gyartas_kiiras.php",
            data: {datum: datum},
//            datatype: "json",
            success: function (valasz) {
//                console.log(valasz);
                $("#napi_gyartas_tablazat").html(valasz);
            }
        });
        $("#nyomtatas").show();


    });

    $("#nyomtatas").click(function (){

        $('#new_window_parameter_1').val($("#napi_gyartas_tablazat").html());
        $('#invisible_form').submit();
    });

</script>
