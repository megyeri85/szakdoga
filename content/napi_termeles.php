<input type="button" id="proba" value="proba ">
<input type="text" id="buffer">
<input value="teszt " type="button" onclick='alert($("#calendar").val())'>
<div class="container" style="display: inline-block">
    <h3> Highlight Particular Dates in JQuery UI Datepicker </h3>

    <input type="text" id="calendar">
</div>


<script type="text/javascript">
    jQuery(document).ready(function () {

        // An array of dates
        var eventDates = {};

        <?php
        $t = array();
        $t[] = "11/28/2015" ;

        foreach($t as $datum){
            echo "eventDates[new Date('$datum')] = new Date('$datum');";
        }
        ?>
//        eventDates[new Date('12/04/2014')] = new Date('12/04/2014');
//        eventDates[new Date('12/06/2014')] = new Date('12/06/2014');
//        eventDates[new Date('12/20/2014')] = new Date('12/20/2014');
//        eventDates[new Date('11/25/2015')] = new Date('11/25/2015');

        // datepicker
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

    $("#proba").click(function () {
        $.ajax({
            type: "POST",
            url: "includes/napi_termeles_lista.php",
            data: {},
            datatype: "json",
            success: function (valasz) {
                valasztomb = JSON.parse(valasz);
                var eventDates = {};

                for(i=0; i<valasztomb.length;i++){
                    eventDates[new Date(valasztomb[i])] =new Date(valasztomb[i]);
                }
                $(".container").html("<h3> Highlight Particular Dates in JQuery UI Datepicker </h3><input type='text' id='calendar'>");

                jQuery('#calendar').datepicker({
                    beforeShowDay: function (date) {
                        var highlight = eventDates[date];
                        if (highlight) {
                            return [true, "event", "highlight"];
                        } else {
                            return [true, '', ''];
                        }
                    },
                    onSelect: function(dateText, inst) {
                        var dateAsObject = $("#calendar").datepicker( 'getDate' ); //the getDate method
                        $("#buffer").val(dateAsObject.toString("dd-MM-yyyy"));
                    }
                });
            }
        });

    });


</script>