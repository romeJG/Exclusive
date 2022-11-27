<?php
ini_set('display_errors', 'On');
error_reporting();
include 'admin/connect.php';

$tpl  ='include/templates/';
$css  = 'layout/css/';
$js   = 'layout/js/';
$lang ='include/languages/'; 
$func = 'include/functions/';


include $func . 'function.php';
include $lang .'english.php';
include 'layout/header.php';
if(!isset($Nonavbar)){
    include $tpl .'navbar.php';
    }
?>