<!DOCTYPE html>
<?php
session_start();
include("includes/beleptetes.php");
require_once("includes/functions.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />

<!--    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link href="style/styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <title>Bécsi Pékség</title>

</head>

<body>

<div id="wrapper">
    <div id="header">
        <div id="header2">
            <div id="logo">
                logo
                logo
                logo
            </div>
            <div id="menu">
                <?php
                 include("content/menu.php");
                ?>


            </div>
        </div>
    </div>
    <div id="bigcontent">
        <div id="leftside">
            <div id="belepes">
                <?php
                include("content/belepes.php");
                ?>
            </div>
            <div id="hirek">
                <?php
                include("content/hirek.php")
                ?>
            </div>
        </div>
        <div id="rightside">

        </div>
    </div>
    lofasz
</div>

<script src="style/js/jQuery.js"></script>
<script src="style/js/menu.js"></script>
<script src="style/js/scripts.js"></script>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!--<script type="text/javascript" src="style/js/jquery.myAccordion.1.0.min.js"></script>-->

<script src="style/js/date.js"></script>
<!-- cdn for modernizr, if you haven't included it already -->
<!--<script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>-->
<!--<!-- polyfiller file to detect and load polyfills -->-->
<!--<script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>-->
<!--<script>-->
<!--    webshims.setOptions('waitReady', false);-->
<!--    webshims.setOptions('forms-ext', {types: 'date'});-->
<!--    webshims.polyfill('forms forms-ext');-->
<!--</script>-->
<!---->
<!--<input type="date" />-->


</body>
</html>
