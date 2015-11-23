<!doctype html>
<html lang="en">
<head>
    <title> How to Highlight Particular Dates in JQuery UI Datepicker </title>
    <meta charset="utf-8">
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

    <!--    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link href="style/styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script type="text/javascript">
        jQuery(document).ready(function() {

            // An array of dates
            var eventDates = {};
            eventDates[ new Date( '12/04/2014' )] = new Date( '12/04/2014' );
            eventDates[ new Date( '12/06/2014' )] = new Date( '12/06/2014' );
            eventDates[ new Date( '12/20/2014' )] = new Date( '12/20/2014' );
            eventDates[ new Date( '11/25/2015' )] = new Date( '11/25/2015' );

            // datepicker
            jQuery('#calendar').datepicker({
                beforeShowDay: function( date ) {
                    var highlight = eventDates[date];
                    if( highlight ) {
                        return [true, "event", "highlight"];
                    } else {
                        return [true, '', ''];
                    }
                }
            });
        });
    </script>

</head>
<body>
<div class="container">
    <h3> Highlight Particular Dates in JQuery UI Datepicker </h3>

    <div id="calendar" > </div>
</div>
</body>
</html>