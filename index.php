<!DOCTYPE HTML>
<?php
session_start();
include("includes/beleptetes.php");
require_once("includes/functions.php");
?>
<!--<html>-->
<head>
    <meta charset="utf-8">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/smoothness/jquery-ui.css" rel="stylesheet"
          type="text/css"/>

    <!--    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link href="style/styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="style/style.css">


    <!-- Start VisualLightBox.com HEAD section -->
    <link rel="stylesheet" href="content/galeria_files/vlb_files1/vlightbox1.css" type="text/css"/>
    <link rel="stylesheet" href="content/galeria_files/vlb_files1/visuallightbox.css" type="text/css" media="screen"/>
    <!-- Start VisualLightBox.com HEAD section -->


    <title>Bécsi Pékség</title>

</head>

<body>

<div id="wrapper">
    <div id="header">
        <div id="header2">
            <div id="logo">
                <img src="style/images/pekseglogo.png" style="height: 115px; width: 143px">
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
            <?php
            include("content/kezdolap.php")
            ?>
        </div>
    </div>
    <div id="footer">BécsiPékség Készítte: Megyeri László 2015</div>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<!--<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->

<script src="style/js/jQuery.js"></script>
<script src="style/js/menu.js"></script>
<script src="style/js/scripts.js"></script>

<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script src="style/js/date.js"></script>


<!-- Start VisualLightBox.com Script section -->
<!--<script src="content/galeria_files/vlb_engine/jquery.min.js" type="text/javascript"></script>-->
<script src="content/galeria_files/vlb_engine/visuallightbox.js" type="text/javascript"></script>
<!-- End VisualLightBox.com Script section -->


</body>
</html>
<?php



?>
