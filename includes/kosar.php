<?php
session_start();
include( "connect.inc.php");
if(isset( $_POST['id']) and isset( $_POST['mennyiseg'])){
    echo"pimpi";
    if(!isset($_SESSION['kosar'])){
        $_SESSION['kosar'] = array();
    }
    if( $_POST['mennyiseg']>0){
        $_SESSION['kosar'][$_POST['id']]= $_POST['mennyiseg'];
    }else {
        unset($_SESSION['kosar'][$_POST['id']]);
    }
}