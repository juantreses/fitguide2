<?php
session_start();
$_SESSION["head_printed"] = false;
$_application_folder = "/wdev_joannes/fitguide2/";

require_once "pdo.php";                          //database functies
require_once "sql.php";
require_once "view_functions.php";      //basic_head, load_template, replacecontent...
require_once "show_messages.php";
require_once "authorization.php";

if ( ! isset($_SESSION['usr']) AND ! $register AND ! $index AND ! $login AND ! $no_access)
{
    ! $index ? $redirect = "Location: ". $_application_folder ."no_access.php?index=true" : $redirect = "Location: ". $_application_folder ."no_access.php?index=false" ;
    header( $redirect );
}